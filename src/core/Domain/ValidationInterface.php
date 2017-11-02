<?php

namespace Taskaholic\Core\Domain;


interface ValidationInterface
{
    public function validate($data);
    public function getErrors();
}
