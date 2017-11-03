<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Taskaholic\Core\Collection\EntityCollection;
use Taskaholic\Core\Domain\Response\ResponseInterface;


class FindUsersResponse implements ResponseInterface
{
    protected $users;
    protected $errors;

    public function __construct(EntityCollection $users)
    {
        $this->errors = [];
        $this->users = $users->toArray();
    }

    public function getData()
    {
        return $this->users;
    }

    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }
}
