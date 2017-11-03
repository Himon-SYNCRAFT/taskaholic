<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Taskaholic\Core\Collection\EntityCollection;
use Taskaholic\Core\Domain\Response\ResponseInterface;


class FindUsersResponse implements ResponseInterface
{
    protected $users;
    protected $errors;

    public function __construct(EntityCollection $users = null)
    {
        $this->errors = [];

        if ($users) {
            $this->users = $users->toArray();
        }
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
        if (is_array($error)) {
            foreach ($error as $err) {
                $this->errors[] = $err;
            }
        } else {
            $this->errors[] = $error;
        }
    }
}
