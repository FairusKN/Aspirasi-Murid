<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests\Comment\CreateCommentRequest;

class CommentController extends Controller
{
    use AuthorizesRequests;

    //public function __invoke(CommentService $commentService) {}

    public function create(CreateCommentRequest $request, $feedbackId)
    {
        // Merge Array from req + additional value
        $fields = array_merge($request->validated(), [
            "feedback_id" => $feedbackId,
            "user_id" => Auth::id()
        ]);

        Comment::create($fields);

        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.comment')
                ]
            )
        );
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('isUserCreateThisComment');
        $comment->delete();
        return redirect()->route("pages.dashboard")->with(
            "success",
            __(
                'messages.deleted',
                [
                    'attribute' => __('models.comment')
                ]
            )
        );
    }
}
