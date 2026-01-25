<?php

namespace App\Service\Dashboard;

use App\Models\Feedback;
use App\Enum\FeedbackStatus;

class AdminDashboardService
{
    protected array $data;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function __invoke()
    {
        $this->data["total_feedback"] =  Feedback::count();
        $this->data["total_feedback_completed"] = Feedback::where("status", FeedbackStatus::Complete->value)->count();
        $this->data["total_feedback_in_progress"] = Feedback::where("status", FeedbackStatus::Processing->value)->count();
        $this->data["total_feedback_waiting"] = Feedback::where("status", FeedbackStatus::Waiting->value)->count();

        $this->data["recent_feedback"] = Feedback::latest()->take(6)->get();

        return $this->data;
    }
}
