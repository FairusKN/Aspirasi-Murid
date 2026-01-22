<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\UserRole;

use App\Http\Requests\User\CreateStudentRequest;
use App\Http\Requests\User\CreateAdminRequest;


class UserController extends Controller
{
    public function createStudent(CreateStudentRequest $request)
    {
        User::create($request->validated());
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.student')
                ]
            )
        );
    }

    public function createAdmin(CreateAdminRequest $request)
    {
        User::create(array_merge(
            $request->validated(),
            ["role" => UserRole::Admin->value]
        ));
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.student')
                ]
            )
        );
    }
}
