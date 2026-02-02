<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthPageController extends Controller
{
    public function loginPage()
    {
        return Auth::check() ? redirect()->route('pages.dashboard') : view('web.auth.login');
    }

    public function registerPage()
    {
        return Auth::check() ? redirect()->route('pages.dashboard') : view('web.auth.register');
    }
}
