<?php

namespace Architecture\User\Application;

use Architecture\User\Domain\UserEntity;
use Architecture\User\Infrastructure\Repository\UserRepository;

readonly class UserRegisterUseCase
{
    public function __construct(
        protected UserRepository $userRepository,
        protected UserEntity $userEntity
    ) {}

    public function execute(array $data): UserEntity
    {
        $this->userEntity->hydrate($data);

        return $this->userRepository->save($this->userEntity);
    }
}
