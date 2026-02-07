<?php

namespace App\Service;

use App\Models\User;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Pagination\LengthAwarePaginator;

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
     *  Activate toggle for User
     *
     *  @param User $userToChange
     *  @return User
     *
     *  if  a User is_active, it'll become false
     *  Else it'll become true
     *
     */
    public function activateToggle(User $userToChange): bool
    {
        $userToChange->update([
            // If is_active is true, then it will become false
            // Else it will become True
            'is_active' => $userToChange->is_active ? false : true
        ]);
        return $userToChange->fresh()->is_active;
    }

    /**
     *
     * Get 10 Users in pagination with filter.
     *
     * @param array $filter
     * @return LengthAwarePaginator
     *
     * If user is an admin, Query default to student-only
     *
     * Filter has , 'full_name' , 'nis', 'class', 'is_active', and 'role' if user is a SuperAdmin
     */
    public function userPaginationQuery(array $filter): LengthAwarePaginator
    {
        $query = User::query();

        $query->when(
            /** @disregard P1013 Undefined method */
            Auth::user()->role === UserRole::Admin->value,
            fn($q) => $q->where('role', UserRole::Student->value)
        );

        $query->when(
            isset($filter['email']),
            fn($q) => $q->where('username', 'ILIKE', '%' . $filter['username'] . "%")
        );

        $query->when(
            isset($filter['full_name']),
            fn($q) => $q->where('full_name', 'ILIKE', '%' . $filter['full_name'] . "%")
        );

        $query->when(
            isset($filter['nis']),
            fn($q) => $q->where('nis', 'ILIKE', '%' . $filter['nis'] . "%")
        );

        $query->when(
            isset($filter['class']),
            fn($q) => $q->where('class', 'ILIKE', '%' . $filter['class'] . "%")
        );

        $query->when(
            isset($filter['is_active']),
            fn($q) => $q->where('is_active', $filter['is_active'])
        );

        $query->when(
            isset($filter['role']) && Auth::user()->role === UserRole::SuperAdmin->value,
            fn($q) => $q->where('role', $filter['role'])
        );

        $query->orderBy('full_name', 'asc');

        $data = $query->paginate(10);

        return $data;
    }

    public function makeUserModel(array $fields): User
    {
        $fields['role'] = $fields['role'] ?? UserRole::Student->value;
        return User::make($fields);
    }

    public function createUser(array $fields): User
    {
        //if role is null, then it is admin craete student. Otherwise it is superadmin create a user
        $fields['role'] = $fields['role'] ?? UserRole::Student->value;

        // If password is null, then it will use nis. If nis is null, it will use default
        $fields['password'] = $fields['password'] ?: $fields['nis'] ?: "default123";


        return User::create($fields);
    }
}
