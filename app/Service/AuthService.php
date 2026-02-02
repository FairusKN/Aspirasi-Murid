<?php

namespace App\Service;

use App\Mail\VerifyEmailCodeMail;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\AuthenticationException;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser(array $fields): void
    {
        // Check if role is empty mean its a user
        if (!isset($fields['role'])) $fields['role'] = UserRole::Student->value;

        $user = User::create($fields);
        $this->generateEmailVerificationToken($user);
    }

    public function resendEmailVerification(array $fields): void
    {
        $user = User::where('email', $fields['email'])->firstOrFail();
        $this->generateEmailVerificationToken($user);
    }

    protected function generateEmailVerificationToken(User $user): void
    {
        $code = random_int(100000, 999999);
        $minute_expired = 2;
        DB::table('email_verification_codes')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'code' => $code,
                'expires_at' => now()->addMinutes($minute_expired)
            ]
        );

        Mail::to($user->email)->send(new VerifyEmailCodeMail($code, $user->full_name, $minute_expired));
    }


    public function verificationEmail(array $fields): void
    {
        $user = User::where('email', $fields["email"])->firstOrFail();
        $record = DB::table('email_verification_codes')
            ->where('user_id', $user->id)
            ->where('code', $fields["code"])
            ->first();

        if (!$record || now()->greaterThan($record->expires_at)) {
            throw new AuthenticationException('Token Kadaluarsa.');
        }

        $user->markEmailAsVerified();
        DB::table('email_verification_codes')->where('user_id', $user->id)->delete();
    }


    /**
     *
     * Try Login.
     * If login is not succeed, will automatically Throw an error.
     *
     * @param array $fields
     * @return void
     *
     */
    public function tryLogin(array $fields): void
    {
        // Check Credentials
        if (!Auth::attempt($fields)) throw new AuthenticationException(__('auth.failed'));

        $user = User::where('email', $fields['email'])->first();

        // Check Another stuff
        $this->isEmailVerified($user);
        $this->isUserActive($user);
    }

    /**
     *
     * Check if User is a student and Email is verified.
     * If User is not a student, Bypass
     *
     * @param User $user
     * @return bool
     *
     */
    protected function isEmailVerified(User $user): bool
    {
        if (!$user->email_verified_at && $user->role === UserRole::Student->value) throw new AuthenticationException(__('auth.email_not_verified'));
        return true;
    }

    /**
     *
     * Check if User is active no matter the role.
     *
     * @param User $user
     * @return bool
     *
     */
    protected function isUserActive(User $user): bool
    {
        if (!$user || !$user->is_active) throw new AuthenticationException(__('auth.not_active'));
        return true;
    }
}
