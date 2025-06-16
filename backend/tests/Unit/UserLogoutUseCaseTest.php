<?php

namespace Tests\Unit;

use Architecture\User\Application\UserLogoutUseCase;
use Architecture\User\Infrastructure\Authentication\AuthenticationInterface;
use PHPUnit\Framework\TestCase;

class UserLogoutUseCaseTest extends TestCase
{
    public function testClassUserLogoutUseCaseShouldLogoutUser(): void
    {
        $laravelAuthenticationMock = $this->createMock(AuthenticationInterface::class);
        $laravelAuthenticationMock
            ->expects($this->once())
            ->method('logout')
            ->willReturnCallback(function (string $token) {
                $this->assertEquals('2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4', $token);
            })
        ;

        $userLogoutUseCase = new UserLogoutUseCase($laravelAuthenticationMock);
        $userLogoutUseCase->execute('2|K2XcjBXVUj6mM7YVA3KnFEYCIo1m4RoI50sr3MOj6ff882c4');
    }
}
