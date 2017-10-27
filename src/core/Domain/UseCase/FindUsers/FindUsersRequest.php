<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;


class FindUsersRequest
{
    private $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function getFilters()
    {
        return $this->filters;
    }
}
