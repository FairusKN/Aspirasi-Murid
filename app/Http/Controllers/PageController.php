<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Enum\UserRole;

class PageController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role == UserRole::Admin->value) return view('admin.dashboard');
        else if ($user->role == UserRole::Student->value) return view('student.dashboard');
    }
}
