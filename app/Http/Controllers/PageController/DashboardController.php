<?php

namespace App\Http\Controllers\PageController;

use App\Service\Dashboard\AdminDashboardService;
use App\Service\Dashboard\StudentDashboardService;
use App\Service\Dashboard\RecipientDashboardService;

use App\Http\Controllers\Controller;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        return match ($user->role) {
            UserRole::Admin->value => view('web.admin.dashboard')->with("data", new AdminDashboardService()()),
            UserRole::Student->value => view('web.student.dashboard')->with("data", new StudentDashboardService()()),
            UserRole::Recipient->value => view('web.recipient.dashboard')->with("data", new RecipientDashboardService()()),
            UserRole::SuperAdmin->value => redirect()->route('pages.createAdmin'),
            default => abort(403, 'Unauthorized')
        };
    }
}
