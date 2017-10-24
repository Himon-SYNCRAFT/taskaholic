<?php

namespace Taskaholic\Core\Domain;


class ResponseFailure
{
    protected $errors;

    public function __construct($errors)
    {
        if (is_array($errors)) {
            $this->errors = $errors;
        } else {
            $this->errors = [$errors];
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
