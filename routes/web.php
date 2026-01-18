<?php

use Illuminate\Support\Facades\Route;

// Logic
use App\Http\Controllers\AuthController;

// Page COntroller
use App\Http\Controllers\PageController\LoginController;
use App\Http\Controllers\PageController\DashboardController;

Route::get('/', function () {
    return redirect()->route('page.login');
});

Route::prefix("/auth")->group(function () {
    Route::get("/login", LoginController::class)->name('page.login');
    Route::post("/login", [AuthController::class, 'login'])->middleware("throttle:5,1")->name("auth.login");
    Route::post("/logout", [AuthController::class, 'logout'])->name('auth.logout');
});


#Super admin
#Route::get("/create_admin");
#Route::post("/create_admin");

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", DashboardController::class)->name('page.dashboard');
});
