<?php

namespace Tests\Unit;

use Architecture\User\Application\UserRegisterUseCase;
use Architecture\User\Domain\UserEntity;
use Architecture\User\Infrastructure\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRegisterUseCaseTest extends TestCase
{
    public function testClassRegisterUserUseCaseShouldCreateUser(): void
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock
            ->expects($this->once())
            ->method('save')
            ->willReturnCallback(function ($user) {
                $user->id = 1;
                $user->token = '2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4';

                return $user;
            });

        $userRegisterUseCase = new UserRegisterUseCase($userRepositoryMock, new UserEntity());

        $result = $userRegisterUseCase->execute([
            'name' => 'test',
            'email' => 'email@gmail.com',
            'password' => '12345678',
        ]);

        $expected = [
            'id' => 1,
            'name' => 'test',
            'email' => 'email@gmail.com',
            'password' => '12345678',
            'token' => '2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4',
        ];

        $this->assertEquals($expected, (array)$result);
    }
}
