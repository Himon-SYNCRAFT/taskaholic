<?php

namespace Taskaholic\Core\Domain\Repository;


interface UserRepositoryInterface
{
    public function get($userId);
    public function find($filter);
    public function all();
}
