<?php

namespace Architecture\User\Infrastructure\Repository;

use Architecture\User\Domain\UserEntity;

/**
 * @template T
 */
interface RepositoryInterface
{
    /**
     * @param T $user
     * @return T
     */
    public function save($user);
}
