<?php

namespace Taskaholic\Data\Repository\InMemory;

use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Collection\EntityCollection;


class InMemoryUserRepository implements UserRepositoryInterface
{
    private $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function get($id)
    {
        foreach ($this->items as $item) {
            if ($item['id'] === $id) {
                return $this->toDomainModel($item);
            }
        }

        return null;
    }

    public function find($filters)
    {
        $result = [];

        foreach ($this->items as $item) {
            foreach ($filters as $filter) {
                $parameter = $filter['parameter'];
                $value = $filter['value'];

                $parameterExists = array_key_exists($parameter, $item);

                if ($parameterExists && $item[$parameter] === $value) {
                    $result[] = $this->toDomainModel($item);
                }
            }
        }

        $collection =  new EntityCollection($result);
        return $collection;
    }

    public function all()
    {
        $result = [];

        foreach ($this->items as $item) {
            $result[] = $this->toDomainModel($item);
        }

        return new EntityCollection($result);
    }

    private function toDomainModel($item)
    {
        return User::fromArray($item);
    }
}
