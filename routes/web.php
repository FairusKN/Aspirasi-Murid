<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/auth")->middleware("throttle:5,1")->group(function () {
    Route::get("/login", [AuthController::class, 'loginView']);
    Route::post("/login", [AuthController::class, 'login']);
});
