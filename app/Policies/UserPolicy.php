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
        // Punish Superadmin creation
        if ($target->role === UserRole::SuperAdmin->value) return redirect()->away('https://en.wikipedia.org/wiki/Loser');

        if ($target->role === UserRole::Admin->value) return $actor->role === UserRole::SuperAdmin->value;

        if ($target->actor === UserRole::Student->value) {
            return in_array($actor->role, [
                UserRole::SuperAdmin->value,
                UserRole::Admin->value
            ]);
        }

        return false;
    }

    public function deactivate(User $actor, User $target): bool
    {
        // no self-deactivation
        if ($actor->id === $target->id) {
            return false;
        }

        if ($actor->role === UserRole::SuperAdmin->value) {
            return $actor->role !== $target->role;
        }

        if ($actor->role === UserRole::Admin->value) {
            return $target->role === UserRole::Student->value;
        }

        return false;
    }
}
