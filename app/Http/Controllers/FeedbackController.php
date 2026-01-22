<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Feedback;
use App\Service\FeedbackService;

use App\Http\Requests\Feedback\CreateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateResponseFeedbackRequest;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected FeedbackService $feedbackService
    ) {}

    public function create(CreateFeedbackRequest $request)
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

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
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

    public function destroy(Feedback $feedback)
    {
        $this->authorize('isUserCreateThisFeedback', $feedback);
        $feedback->delete();
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

    public function adminResponse(UpdateResponseFeedbackRequest $request, Feedback $feedback)
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
