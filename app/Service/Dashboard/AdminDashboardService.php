<?php

namespace App\Service\Dashboard;

use App\Models\User;
use App\Models\Feedback;

class AdminDashboardService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function makeFilterQuery(array $filter)
    {
        $query = Feedback::query();

        if (isset($filter['feedback_title'])) {
            $query->where('feedback_title', $filter['feedback_title']);
        }
    }
}
