<?php

namespace Architecture\User\Infrastructure\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LaravelAuthentication implements AuthenticationInterface
{
    public function checkLogin(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function getGeneratedUserToken(string $email): string
    {
        $user = User::where('email', $email)->firstOrFail();
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function logout(string $token): void
    {
        $token = PersonalAccessToken::findToken($token) ?? false;
        if (false === $token) {
            throw new \Exception('Token not found');
        }
        $token->delete();
    }
}
