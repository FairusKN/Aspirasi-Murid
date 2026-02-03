<?php

use Illuminate\Support\Facades\Route;

// Logic
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ChatBotController;

// Page COntroller
use App\Http\Controllers\PageController\AuthPageController;
use App\Http\Controllers\PageController\DashboardController;

Route::get('/', function () {
    return redirect()->route('pages.login');
});

Route::prefix("/auth")->group(function () {
    Route::get("/login", [AuthPageController::class, 'loginPage'])->name('pages.login');
    Route::post("/login", [AuthController::class, 'login'])->middleware("throttle:5,1")->name("auth.login");

    //Route::get('/register', [AuthPageController::class, 'registerPage'])->name('pages.register');
    //Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('auth.register');

    //Route::get("/email/verify", [AuthPageController::class, 'verifyPage'])->name('pages.verify');
    //Route::post("/email/verify/{email}/{token}", [AuthController::class, 'verifyEmail'])->name('auth.verify.email');
    //Route::post("/email/resend", [AuthController::class, "resend"])->name('auth.resend');

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

Route::get('/chat/{prompt}', [ChatBotController::class, 'chatBot'])->name('ai');
