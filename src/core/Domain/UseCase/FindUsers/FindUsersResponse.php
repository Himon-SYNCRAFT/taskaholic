<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;


class FindUsersResponse
{
    private $users;

    public function __construct($users = [])
    {
        $this->users = $users;
    }

    public function getUsers()
    {
        return $this->users;
    }
}
