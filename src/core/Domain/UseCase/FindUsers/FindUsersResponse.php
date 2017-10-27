<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Taskaholic\Core\Collection\EntityCollection;


class FindUsersResponse
{
    private $users;

    public function __construct(EntityCollection $users)
    {
        $this->users = $users->toArray();
    }

    public function getUsers()
    {
        return $this->users;
    }
}
