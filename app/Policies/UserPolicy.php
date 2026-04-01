<?php

namespace App\Policies;

use App\Models\User;
use App\Enum\UserRole;

use Illuminate\Http\RedirectResponse;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $actor, User $target): bool | RedirectResponse
    {
        return match ($target->role) {
            UserRole::SuperAdmin->value => redirect()->away('https://en.wikipedia.org/wiki/Loser'), // Punish for SuperAdmin Creation
            UserRole::Admin->value => $actor->role === UserRole::SuperAdmin->value, // if target = admin, is actor role == superadmin?
            UserRole::Student->value => $actor->role !== UserRole::Student->value, // if target = student, is actor role != student ?
            default => false
        };
    }

    public function canActivateToggle(User $actor, User $target): bool
    {
        return match ($actor->role) {
            UserRole::SuperAdmin->value => $actor->role !== $target->role, // SuperAdmin can deactivate anyone below them
            UserRole::Admin->value => $target->role === UserRole::Student->value || $target->role === UserRole::Recipient->value, // admin can deactivate student only
            default => false
        };
    }
}
