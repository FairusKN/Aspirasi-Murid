<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\AuthService;

use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\ResendVerifyEmailRequest;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->authService->createUser($fields);

        return back()->with('success', __('auth.regist_success'));
    }

    public function verifyEmail(VerifyEmailRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->authService->verificationEmail($fields);
        return redirect()->route('pages.login');
    }

    public function resend(ResendVerifyEmailRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->authService->resendEmailVerification($fields);
        return redirect()->route('pages.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->authService->tryLogin($fields);

        $request->session()->regenerate();
        return redirect()->route('pages.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
