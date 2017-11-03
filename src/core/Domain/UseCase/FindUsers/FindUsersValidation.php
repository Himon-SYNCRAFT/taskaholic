<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as V;
use Taskaholic\Core\Domain\Validation\ValidationInterface;


class FindUsersValidation implements ValidationInterface
{
    protected $validator;
    protected $errors;

    public function __construct()
    {
        $this->validator = V::attribute(
            'filters',
            V::arrayType()->each(
                V::oneOf(
                    V::key('parameter', V::equals('id'))
                    ->key('value', V::intVal()),
                    V::key('parameter', V::equals('name'))
                    ->key('value', V::alpha())
                )
            )
        );

        $this->errors = [];
    }

    public function validate($data)
    {
        try {
            $this->validator->assert($data);
            return true;
        } catch (NestedValidationException $e) {
            $this->errors = $e->getFullMessage();
            return false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
