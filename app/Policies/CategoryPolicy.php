<?php

namespace App\Policies;

use App\Models\User;
use App\Enum\UserRole;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Category $category)
    {
        return $user->role === UserRole::Admin->value;
    }
}
