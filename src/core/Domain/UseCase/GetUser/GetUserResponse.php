<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use \stdClass;
use Taskaholic\Core\Domain\Entity\User;


class GetUserResponse
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = new stdClass();
        $this->user->id = $user->getId();
    }

    public function getUser()
    {
        return clone $this->user;
    }
}
