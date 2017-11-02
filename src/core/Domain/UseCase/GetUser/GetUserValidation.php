<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use Respect\Validation\Validator;
use Taskaholic\Core\Domain\ValidationInterface;
use Respect\Validation\Exceptions\NestedValidationException;


class GetUserValidation implements ValidationInterface
{
    protected $errors;

    public function __construct()
    {
        $this->errors = [];
        $this->validator = Validator::IntVal()->positive();
    }

    public function validate($data)
    {
        try {
            $this->validator->assert($data);
            return true;
        } catch (NestedValidationException $e) {
            $this->errors = $e->getMessages();
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
