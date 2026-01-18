<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        return match ($user->role) {
            UserRole::Admin->value => view('admin.dashboard'),
            UserRole::Student->value => view('student.dashboard')
        };
    }
}
