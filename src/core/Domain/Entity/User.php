<?php

namespace Taskaholic\Core\Domain\Entity;


class User
{
    private $id;

    public function __construct(int $userId)
    {
        $this->id = $userId;
    }

    public function getId() {
        return $this->id;
    }
}
