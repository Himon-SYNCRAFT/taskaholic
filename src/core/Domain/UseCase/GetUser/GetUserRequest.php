<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;


class GetUserRequest
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }
}
