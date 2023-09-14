<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /* The code `Gate::define('admin', function () {
            return ->role == 'admin';
        });` is defining a gate named 'admin' in Laravel's authorization system. */
        Gate::define('admin', function ($user) {
            return $user->role == 'admin';
        });

        /* The code `Gate::define('user', function () {
            return ->role == 'user';
        });` is defining a gate named 'user' in Laravel's authorization system. This gate allows you
        to check if a user has the role of 'user'. */
        Gate::define('user', function ($user) {
            return $user->role == 'user';
        });
    }
}
