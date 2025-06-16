<?php

namespace Architecture\User\Application;

use Architecture\User\Application\DTO\UserTokenDTO;
use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;

readonly class UserLoginUseCase
{
    protected string $email;

    protected string $password;

    public function __construct(
        protected AuthenticationInterface $authentication
    ) {
    }

    public function setCredentials(string $email, string $password): void
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function execute(): UserTokenDTO
    {
        if (false === $this->authentication->checkLogin($this->email, $this->password)) {
            throw new \Exception('Invalid credentials');
        }

        $token = $this->authentication->getGeneratedUserToken($this->email);

        return new UserTokenDTO($this->email, $token);
    }
}
