<?php

namespace Architecture\User\Application;

use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;

readonly class UserLogoutUseCase
{
    public function __construct(
        protected AuthenticationInterface $authentication
    ) {
    }

    public function execute(string $token): void
    {
        $this->authentication->logout($token);
    }
}
