<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateStudentRequest;


class UserController extends Controller
{
    public function createStudent(CreateStudentRequest $request)
    {
        $data = User::create($request->validated());
        return back()->with($data);
    }
}
