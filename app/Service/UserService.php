<?php

namespace App\Service;

use App\Models\User;
use App\Enum\UserRole;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     *
     *  Deactivate a User
     *
     *  @param User $userToDeactivate
     *  @return User
     *
     */
    public function deactivateUser(User $userToDeactivate): User
    {
        $userToDeactivate->update(['is_active' => false]);
        return $userToDeactivate->fresh();
    }
}
