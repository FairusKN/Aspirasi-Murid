<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\UserRole;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateStudentRequest;
use App\Http\Requests\User\CreateAdminRequest;


class UserController extends Controller
{
    public function createStudent(CreateStudentRequest $request)
    {
        return back()->with(User::create($request->validated()));
    }

    public function createAdmin(CreateAdminRequest $request)
    {
        $fields = $request->validated();
        $fields['role'] = UserRole::Admin->value;
        return back()->with(User::create($fields));
    }
}
