<?php

namespace Architecture\User\Infrastructure\Repository;

/**
 * @template T
 */
interface RepositoryInterface
{
    /**
     * @param  T  $user
     * @return T
     */
    public function save($user);
}
