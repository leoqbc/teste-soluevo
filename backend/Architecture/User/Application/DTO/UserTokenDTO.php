<?php

namespace Architecture\User\Application\DTO;

class UserTokenDTO
{
    public function __construct(
        public string $email,
        public string $token
    ) {
    }
}
