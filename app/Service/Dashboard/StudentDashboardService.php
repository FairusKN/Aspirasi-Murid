<?php

namespace App\Service\Dashboard;

use Illuminate\Support\Facades\Auth;

class StudentDashboardService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function __invoke()
    {
        /** @disregard P1013 Undefined method */
        $user = Auth::user()->load('hasFeedback');
        return $user;
    }
}
