<?php

namespace Architecture\Task\Infrastructure;

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
