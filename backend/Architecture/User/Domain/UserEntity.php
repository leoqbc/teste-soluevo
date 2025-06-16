<?php

namespace Architecture\User\Domain;

class UserEntity
{
    public int $id;

    public string $token;

    protected(set) public string $name;

    protected(set) public string $email;

    protected(set) public string $password;

    public function hydrate(array $data): void
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function getUserDefaultPermissions(): array
    {
        return ['task:create', 'task:update', 'task:read'];
    }
}
