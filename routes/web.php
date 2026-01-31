<?php

use Illuminate\Support\Facades\Route;

// Logic
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;

// Page COntroller
use App\Http\Controllers\PageController\LoginController;
use App\Http\Controllers\PageController\CreateAdminController;
use App\Http\Controllers\PageController\DashboardController;
use App\Http\Controllers\PageController\FeedbackPageController;

Route::get('/', function () {
    return redirect()->route('pages.login');
});

Route::prefix("/auth")->group(function () {
    Route::get("/login", LoginController::class)->name('pages.login');
    Route::post("/login", [AuthController::class, 'login'])->middleware("throttle:5,1")->name("auth.login");
    Route::post("/logout", [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth', 'is_active'])->group(function () {
    Route::get("/dashboard", DashboardController::class)->name('pages.dashboard');

    Route::prefix('/users')->group(function () {
        #Super admin
        Route::get("/create_admin", CreateAdminController::class)->name('pages.createAdmin');
        Route::post("/create_admin", [UserController::class, 'createAdmin'])->name('users.createAdmin');

        #Admin
        //Route::get('/create_student') // Page here
        Route::post('/create_student', [UserController::class, 'create_student'])->name('users.createStudent');
    });

    Route::prefix('/feedbacks')->middleware(['throttle:150,1'])->group(function () {
        Route::get('/', [FeedbackPageController::class, 'get'])->name('pages.feedback');
        Route::post('/', [FeedbackController::class, 'create'])->name('feedbacks.create');

        Route::get('/{id}', [FeedbackPageController::class, 'index'])->name('feedbacks.detailed')
            ->whereUuid('id');
    });
});
