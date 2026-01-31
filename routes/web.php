<?php

use Illuminate\Support\Facades\Route;

// Logic
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;

// Page COntroller
use App\Http\Controllers\PageController\LoginController;
use App\Http\Controllers\PageController\DashboardController;

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
        Route::get("/", [UserController::class, "show"])->name('pages.users');
        Route::post("/create", [UserController::class, "create"])->name('users.create');
        Route::post("/{user}/toggle-activate", [UserController::class, 'activateToggle'])->name('users.toggle_activate');
    });

    Route::prefix('/feedbacks')->middleware('throttle:80,1')->group(function () {
        Route::get('/', [FeedbackController::class, 'show'])->name('pages.feedback');
        Route::get('/{feedback}', [FeedbackController::class, 'index'])->name('pages.detailed_feedback')
            ->whereUuid('feedback');
        Route::post('/', [FeedbackController::class, 'create'])->name('feedbacks.create');
    });
});
