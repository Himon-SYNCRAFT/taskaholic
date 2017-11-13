<?php

namespace Taskaholic\Core\Domain\Entity;

use Taskaholic\Core\Domain\Entity\EntityInterface;


class User implements EntityInterface
{
    protected $id;
    protected $name;
    protected $passwordHash;

    public function __construct(String $name, int $userId = null, String $passwordHash = null)
    {
        $this->id = $userId;
        $this->name = $name;
        $this->passwordHash = $passwordHash;
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

    public function checkPassword($password)
    {
        return password_verify($password, $this->passwordHash);
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
            $data['id'],
            $data['passwordHash']
        );
    }
}
