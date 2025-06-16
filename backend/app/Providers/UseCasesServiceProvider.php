<?php

namespace App\Providers;

use Architecture\User\Application\UserLoginUseCase;
use Architecture\User\Application\UserRegisterUseCase;
use Architecture\User\Domain\UserEntity;
use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;
use Architecture\User\Infrastructure\Authentication\LaravelAuthentication;
use Architecture\User\Infrastructure\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use Psr\Container\ContainerInterface;

class UseCasesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRegisterUseCase::class, function () {
            return new UserRegisterUseCase(new UserRepository(), new UserEntity());
        });

        $this->app->bind(UserLoginUseCase::class, function (ContainerInterface $container) {
            return new UserLoginUseCase($container->get(AuthenticationInterface::class));
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
