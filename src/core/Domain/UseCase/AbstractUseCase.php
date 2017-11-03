<?php

abstract class AbstractUseCase
{
    abstract public function execute($request);

    public function validateRequest($request) {
        $this->validation->validate($request);
    }
}
