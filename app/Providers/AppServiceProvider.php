<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Custom redirecting to login route name
        Authenticate::redirectUsing(function () {
            return route('auth.login');
        });

        Paginator::useTailwind();

        View::composer('*', function ($view) {
            $view->with('authUser', auth()->user());
        });
    }
}
