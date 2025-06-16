<?php

namespace Architecture\User\Infrastructure\Authentication;

interface AuthenticationInterface
{
    public function checkLogin(string $email, string $password): bool;

    public function getGeneratedUserToken(string $email): string;

    public function logout(string $token): void;
}
