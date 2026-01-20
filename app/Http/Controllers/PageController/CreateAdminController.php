<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateAdminController extends Controller
{
    public function __invoke()
    {
        return view('superadmin.createAdmin');
    }
}
