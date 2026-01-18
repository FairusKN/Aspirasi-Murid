<?php

namespace App\Service;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $fields): Feedback
    {
        $user = Auth::user();
        $fields['user_id'] = $user->id;

        $data = Feedback::create($fields);

        return $data;
    }

    //public function update(array $fields, Feedback $feedback): Feedback {}
    //public function destroy(Feedback $feedback)
    //{
    //    $user = Auth::user();
    //    if($feedback->user_id !== $user->id) throw
    //}
}
