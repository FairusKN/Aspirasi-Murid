<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Feedback;
use App\Service\FeedbackService;
use App\Service\ImageService;

use App\Http\Requests\Feedback\CreateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateResponseFeedbackRequest;
use App\Http\Requests\Feedback\AdminFilterFeedbackRequest;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected FeedbackService $feedbackService,
        protected ImageService $imageService
    ) {}

    public function index(Feedback $feedback): View
    {
        return view('web.shared.detailed_feedback')
            ->with('data', $feedback);
    }

    public function show(AdminFilterFeedbackRequest $request): View
    {
        return view('web.shared.feedback')
            ->with(
                'data',
                $this->feedbackService->feedbackPaginationQuery($request->validated())
            );
    }

    public function create(CreateFeedbackRequest $request): RedirectResponse
    {
        $this->feedbackService->create($request->validated());
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.feedback')
                ]
            )
        );
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback): RedirectResponse
    {
        $this->authorize('isUserCreateThisFeedback', $feedback);
        $feedback->update($request->validated());
        return back()->with(
            "success",
            __(
                'messages.updated',
                [
                    'attribute' => __('models.feedback')
                ]
            )
        );
    }

    public function destroy(Feedback $feedback): RedirectResponse
    {
        $this->authorize('isUserCreateThisFeedback', $feedback);
        $this->feedbackService->destroy($feedback);
        return redirect()->route('pages.dashboard')->with(
            "success",
            __(
                'messages.deleted',
                [
                    'attribute' => __('models.feedback')
                ]
            )
        );
    }

    public function adminResponse(UpdateResponseFeedbackRequest $request, Feedback $feedback): RedirectResponse
    {
        $feedback->update($request->validated());
        return back()->with(
            "success",
            __(
                'messages.updated',
                [
                    'attribute' => __('models.feedback')
                ]
            )
        );
    }
}
