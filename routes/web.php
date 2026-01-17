<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::prefix("/auth")->group(function () {
    Route::get("/login", [PageController::class, 'login']);
    Route::post("/login", [AuthController::class, 'login'])->middleware("throttle:5,1")->name("login_action");
    Route::post("/logout", [AuthController::class, 'logout'])->name('logout_action');
});


#Super admin
#Route::get("/create_admin");
#Route::post("/create_admin");

Route::get("/dashboard", [PageController::class, 'dashboard']);
