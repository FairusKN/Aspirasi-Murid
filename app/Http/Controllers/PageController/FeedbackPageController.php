<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

use App\Http\Requests\Feedback\AdminFilterFeedbackRequest;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Service\FeedbackService;
use App\Http\Resources\FeedbackCollection;


class FeedbackPageController extends Controller
{
    public function __construct(protected FeedbackService $feedback_service) {}

    public function get(AdminFilterFeedbackRequest $request)
    {
        return view('web.shared.feedback')->with('data', $this->feedback_service->feedbackPaginationQuery($request->validated()));
    }

    public function index($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->loadMissing('comments');

        if (Auth::user()->role === UserRole::SuperAdmin->value) {
            $feedback->loadMissing('student');
        }

        $vm = (new FeedbackCollection($feedback));

        dd($vm);

        return view('web.shared.detailed_feedback', ['data' => $vm]);
    }
}
