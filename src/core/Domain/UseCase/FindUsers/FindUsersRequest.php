<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;


class FindUsersRequest
{
    private $filters;

    public function __construct($data = [])
    {
        $this->filters = $data['filters'] ?? null;
    }

    public function getFilters()
    {
        return $this->filters;
    }
}
