<?php

namespace Architecture\User\Infrastructure\Repository;

use App\Models\User;
use Architecture\User\Domain\UserEntity;
use Illuminate\Support\Facades\Hash;

/**
 * @implements RepositoryInterface<UserEntity>
 */
class UserRepository implements RepositoryInterface
{
    /**
     * @param  UserEntity  $user
     * @return UserEntity
     */
    public function save($user): object
    {
        $userModel = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make($user->password),
        ]);
        $user->id = $userModel->id;
        $user->token = $userModel
            ->createToken('auth_token', $user->getUserDefaultPermissions())
            ->plainTextToken;

        return $user;
    }
}
