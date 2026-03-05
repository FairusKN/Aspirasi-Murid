<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

//Middleware
use App\Http\Middleware\EnsureUserIsActive;

//Exceptions
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_active' => EnsureUserIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        //if (in_array(config("app.env"), ["dev", "local"])) {
        //    return;
        //}

        $exceptions->render(function (Throwable $e) {
            if ($e instanceof AuthenticationException) {
                return back()->withErrors(['error' => $e->getMessage()]);
            };
        });
    })->create();
