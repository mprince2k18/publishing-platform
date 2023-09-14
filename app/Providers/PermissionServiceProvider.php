<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('premium', function ($user) {
            return $user->membership->plan_type == 'premium';
        });

        Gate::define('free', function ($user) {
            return $user->membership->plan_type == 'free';
        });
    }
}
