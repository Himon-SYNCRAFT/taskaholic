<?php

namespace Taskaholic\Core\Domain\Validation;


interface ValidationInterface
{
    public function validate($data);
    public function getErrors();
}
