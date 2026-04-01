<?php

namespace App\Service\Dashboard;

use App\Models\Feedback;
use App\Models\AutditLog;
use Illuminate\Support\Facades\DB;
use App\Enum\UserRole;

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
        $this->data['analytics']["total_feedback"] =  Feedback::count();
        $this->data['analytics']['total_feedback_today'] = Feedback::whereDate('created_at', now()->today())->count();
        $this->data['analytics']['total_feedback_status'] = Feedback::all()->countBy('status');
        $this->data['analytics']['total_based_on_category'] =
            Feedback::query()
            ->join('categories', 'feedback.category_id', '=', 'categories.id')
            ->selectRaw('categories.category_name, COUNT(*) as total')
            ->groupBy('categories.category_name')
            ->pluck('total', 'category_name');
        $this->data['analytics']['total_based_on_class'] =  Feedback::join('users', 'feedback.user_id', '=', 'users.id')
            ->where('users.role', UserRole::Student->value)
            ->select('users.class', DB::raw('COUNT(*) as total'))
            ->groupBy('users.class')
            ->get();

        $this->data['analytics']['total_admin_response'] = AutditLog::count();
        $this->data['analytics']['total_admin_response_today'] = AutditLog::whereDate('created_at', now()->today())->count();


        $this->data["recent_feedback"] = Feedback::latest()->take(6)->get();

        return $this->data;
    }
}
