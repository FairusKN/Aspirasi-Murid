<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke()
    {
        return Auth::check() ? redirect()->route('pages.dashboard') : view('web.auth.login');
    }
}
