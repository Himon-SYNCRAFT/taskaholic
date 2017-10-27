<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use \stdClass;
use Taskaholic\Core\Domain\Entity\User;


class GetUserResponse
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user->toArray();
    }

    public function getUser()
    {
        return $this->user;
    }
}
