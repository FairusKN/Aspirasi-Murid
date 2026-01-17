<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $fields = $request->validated();

        if (Auth::attempt($fields)) {
            $request->session()->regenerate();
            dd("Testlmao");
        }
    }
}
