<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Feedback;
use App\Service\FeedbackService;

use App\Http\Requests\Feedback\CreateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Http\Requests\Feedback\UpdateStatusFeedbackRequest;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected FeedbackService $feedbackService
    ) {}

    public function create(CreateFeedbackRequest $request)
    {
        $this->feedbackService->create($request->validated());
        return back()->with('Success creating feedback');
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $this->authorize('isUserCreateThisFeedback', $feedback);
        $feedback->update($request->validated());
        return back()->with('Success updated feedback');
    }

    public function delete(Feedback $feedback)
    {
        $this->authorize('isUserCreateThisFeedback', $feedback);
        $feedback->delete();
        return redirect()->intended('/dashboard');
    }

    public function updateStatus(UpdateStatusFeedbackRequest $request, Feedback $feedback)
    {
        // Update Status Feedback Admin Only
        $feedback->update($request->validated());
        return back();
    }
}
