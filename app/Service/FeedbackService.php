<?php

namespace App\Service;

use App\Models\Feedback;
use App\Service\ImageService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

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
     * Check if directory exists. If not create one.
     *
     * @return void
     */
    private function ensureDirectoryExist(): void
    {
        $path = $this->publicStorage  . "/" . $this->folder_name;

        if (!File::isDirectory($path)) File::makeDirectory($path);
    }
}
