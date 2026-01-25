<?php

namespace App\Http\Controllers\PageController;

use App\Service\Dashboard\AdminDashboardService;

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
            UserRole::Student->value => view('web.student.dashboard'),
            UserRole::SuperAdmin->value => redirect()->route('pages.createAdmin'),
            default => abort(403, 'Unauthorized')
        };
    }
}
