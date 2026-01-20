<?php

use Illuminate\Support\Facades\Route;

// Logic
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Page COntroller
use App\Http\Controllers\PageController\LoginController;
use App\Http\Controllers\PageController\CreateAdminController;
use App\Http\Controllers\PageController\DashboardController;

Route::get('/', function () {
    return redirect()->route('pages.login');
});

Route::prefix("/auth")->group(function () {
    Route::get("/login", LoginController::class)->name('pages.login');
    Route::post("/login", [AuthController::class, 'login'])->middleware("throttle:5,1")->name("auth.login");
    Route::post("/logout", [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", DashboardController::class)->name('pages.dashboard');

    Route::prefix("/feedback")->group(function () {});

    #Super admin
    Route::get("/create_admin", CreateAdminController::class)->name('pages.createAdmin');
    Route::post("/create_admin", [UserController::class, 'createAdmin'])->name('users.createAdmin');
});
