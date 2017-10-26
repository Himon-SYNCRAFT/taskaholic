<?php

namespace Taskaholic\Core\Domain\Entity;

use Taskaholic\Core\Domain\Entity\EntityInterface;


class User implements EntityInterface
{
    protected $id;
    protected $name;

    public function __construct(String $name, int $userId = null)
    {
        $this->id = $userId;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public static function fromArray($data)
    {
        return new User(
            $data['name'],
            $data['id']
        );
    }
}
