<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\AdminFilterFeedbackRequest;

use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;

use App\Service\Feedback\AdminFeedbackService;

class FeedbackPageController extends Controller
{
    public function __invoke(AdminFilterFeedbackRequest $request)
    {
        $user = Auth::user();


        return match ($user->role) {
            UserRole::Admin->value => view('web.admin.feedback')->with('data', new AdminFeedbackService()($request->validated())),
            UserRole::Student->value => view('web.student.feedback'),
            default => abort(403, 'Unauthorized')
        };
    }
}
