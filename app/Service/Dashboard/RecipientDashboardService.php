<?php

namespace App\Service\Dashboard;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class RecipientDashboardService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function __invoke()
    {
        $user = Auth::user()->load('hasRecipient');
        $feedbacks = Feedback::where('category_id', $user->hasRecipient->category_id)->get();
        return compact('user', 'feedbacks');
    }
}
