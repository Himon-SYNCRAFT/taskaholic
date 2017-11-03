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
                V::key(
                    'parameter',
                    V::in(['id', 'name'])
                )
                ->key('value')
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
            $this->errors = $e->getMessages();
            return false;
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}
