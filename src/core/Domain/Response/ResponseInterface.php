<?php

namespace Taskaholic\Core\Domain\Response;


interface ResponseInterface
{
    public function getData();
    public function hasErrors();
    public function getErrors();
    public function addError($error);
}
