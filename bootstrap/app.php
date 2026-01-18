<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

//Exceptions
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        //if (in_array(config("app.env"), ["dev", "local"])) {
        //    return;
        //}

        $exceptions->render(function (Throwable $e) {

            // Unauthenticated
            if ($e instanceof AuthenticationException) {
                return redirect()->guest(route('auth.login'));
            };
        });
    })->create();
