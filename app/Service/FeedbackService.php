<?php

namespace App\Service;

use App\Models\Feedback;
use App\Models\AutditLog;
use App\Models\CategoryRecipient;
use App\Service\ImageService;
use App\Enum\LogAction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminResponseMail;

use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackService
{

    protected $publicStorage;
    protected $folder_name;

    /**
     * Create a new class instance.
     */
    public function __construct(protected ImageService $imageService)
    {
        $this->publicStorage = Storage::disk('public');

        // Feedback image folder name
        $this->folder_name = 'feedback_images';

        // Check Dir
        $this->ensureDirectoryExist();
    }

    /**
     *
     * Create a Feedback inside DB.
     *
     * Image processing convert to Webp using name structure : FullName_FeedbackTitle
     *
     * @param array $fields : Validated Request
     * @return Feedback
     *
     */
    public function create(array $fields): Feedback
    {
        $user = Auth::user();
        $fields['user_id'] = $user->id;

        // If image exists, change name, convert to webp then save
        if (isset($fields['image']) &&  $fields['image'] instanceof UploadedFile) {
            $image_name = str_replace(
                " ",
                "_",
                join(
                    "",
                    [$user->full_name, now()->toDateString(), $fields['feedback_title'], ".webp"]
                )
            );

            $image_path = $this->publicStorage->path($this->folder_name . "/" . $image_name);
            ImageService::fromFile($fields['image'])->toWebp($image_path);

            // Overwrite image to full image path
            $saved_image_path = $this->folder_name . "/" . $image_name;
            $fields['image'] = $saved_image_path;
        }

        $data = Feedback::create($fields);

        return $data;
    }

    /**
     *
     * Delete a Feedback from database.
     *
     * Check if Feedback has image, if image exists will delete from storage.
     * Will return void if succeed
     *
     * @param Feedback $feedback
     * @return void
     *
     */
    public function destroy(Feedback $feedback): void
    {
        $image_path = $feedback->image ?: "";
        if ($image_path && $this->publicStorage->exists($image_path))
            Storage::disk('public')->delete($image_path);

        $feedback->delete();
    }

    /**
     *
     * Get a feedback in Pagination type.
     *
     * @param array $filter
     * @return LengthAwarePaginator
     *
     * Query Filter:
     * category, feedback_title, location, anonymous, status, has_image
     *
     */
    public function feedbackPaginationQuery(array $filter): LengthAwarePaginator

    {
        $query = Feedback::query()

            // If User is a superAdmin, User can see the anonym student
            ->when(
                fn($q) => $q->with('student')->when(
                    isset($filter['student_name']),
                    fn($q) => $q->whereRelation('student', 'full_name', 'ILIKE', "%" . $filter['student_name'] . '%')
                )
            )
            ->when(
                isset($filter['category']),
                fn($q) => $q->where('category', 'ILIKE', '%' . $filter['category'] . '%')
            )
            ->when(
                isset($filter['feedback_title']),
                fn($q) => $q->where('feedback_title', 'ILIKE', '%' . $filter['feedback_title'] . '%')
            )
            ->when(
                isset($filter['location']),
                fn($q) => $q->where('location', 'ILIKE', '%' . $filter['location'] . '%')
            )
            ->when(
                isset($filter['anonymous']),
                fn($q) => $q->where('anonymous', $filter['anonymous'])
            )
            ->when(
                isset($filter['status']),
                fn($q) => $q->where('status', $filter['status'])
            )
            ->when(
                isset($filter['has_image']),
                fn($q) => $q->whereNotNull('image')
            );

        $data = $query->paginate(10);

        return $data;
    }

    /**
     * Check if directory exists. If not create one.
     *
     * @return void
     */
    private function ensureDirectoryExist(): void
    {
        $path = "/" . $this->folder_name;

        if (!$this->publicStorage->exists($path)) $this->publicStorage->makeDirectory($path);
    }

    /**
     *
     * Update a feedback field, then Send an email using student relation to get student email.
     * This function is update the feedback model, if field has another field it will got updated too.
     *
     * @param array $field
     * @param Feedback $feedback
     *
     * return void
     */
    public function updateAdminResponse(array $field, Feedback $feedback): void
    {
        $feedback->update($field);
        AutditLog::createLogging(LogAction::ResponseFeedback, "Response feedback: " . $feedback->title);
        $this->emailAfterResponse($feedback);
    }

    protected function emailAfterResponse(Feedback $feedback): void
    {
        // Mail to Category Recipient
        $recipients = CategoryRecipient::where([
            ['from_category', $feedback->category],
            ['is_active', true]
        ])
            ->pluck('email');

        Mail::to($recipients)->send(
            new AdminResponseMail($feedback->fresh())
        );

        // Mail to Student
        Mail::to($feedback->student?->email)->send(
            new AdminResponseMail($feedback->fresh())
        );
    }
}
