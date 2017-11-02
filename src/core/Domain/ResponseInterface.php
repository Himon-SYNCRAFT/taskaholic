<?php

namespace Taskaholic\Core\Domain;


interface ResponseInterface
{
    public function getData();
    public function hasErrors();
    public function getErrors();
    public function addError($error);
}
