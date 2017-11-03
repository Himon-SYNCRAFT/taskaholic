<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\Response\ResponseInterface;


class GetUserResponse implements ResponseInterface
{
    protected $user;
    protected $errors;

    public function __construct(User $user = null)
    {
        $this->errors = [];

        if ($user) {
            $this->user = $user->toArray();
        }
    }

    public function getData()
    {
        return $this->user;
    }

    public function hasErrors() {
        return count($this->errors) > 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($error) {
        if (is_array($error)) {
            foreach ($error as $err) {
                $this->errors[] = $err;
            }
        } else {
            $this->errors[] = $error;
        }
    }
}
