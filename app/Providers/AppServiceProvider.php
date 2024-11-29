<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('access-hr', function ($user) {
            return $user->role_id === 1;
        });

        Gate::define('access-official', function ($user) {
            return $user->role_id === 2;
        });

        Gate::define('access-home', function ($user) {
            return $user->role_id === 3;
        });
    }
}
