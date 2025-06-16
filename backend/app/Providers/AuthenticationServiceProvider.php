<?php

namespace App\Providers;

use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;
use Architecture\User\Infrastructure\Authentication\LaravelAuthentication;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationInterface::class, function () {
            return new LaravelAuthentication();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
