<?php

namespace Tests\Unit;

use Architecture\User\Application\UserLoginUseCase;
use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;
use PHPUnit\Framework\TestCase;

class UserLoginUseCaseTest extends TestCase
{
    public function testClassUserLoginUseCaseShouldLoginUser(): void
    {
        $authenticationMock = $this->createMock(AuthenticationInterface::class);
        $authenticationMock
            ->expects($this->once())
            ->method('checkLogin')
            ->willReturn(true)
        ;

        $authenticationMock
            ->expects($this->once())
            ->method('getGeneratedUserToken')
            ->willReturn('2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4')
        ;

        $email = 'user@gmail.com';
        $password = '12345678';

        $userLoginUseCase = new UserLoginUseCase($authenticationMock);
        $userLoginUseCase->setCredentials($email, $password);

        $result = $userLoginUseCase->execute();

        $this->assertEquals([
            'email' => $email,
            'token' => '2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4',
        ], (array)$result);
    }
}
