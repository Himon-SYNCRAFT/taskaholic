<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Taskaholic\Core\Domain\Validation\ValidationInterface;


class GetUserValidation implements ValidationInterface
{
    protected $errors;

    public function __construct()
    {
        $this->errors = [];
        $this->validator = Validator::Attribute(
            'userId',
            Validator::intVal()->positive()
        );
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
