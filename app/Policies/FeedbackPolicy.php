<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;

class FeedbackPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function isUserCreateThisFeedback(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id;
    }
}
