<?php

namespace Taskaholic\Core\Domain\Entity;


interface EntityInterface
{
    public function getId();
    public function toArray();
    public static function fromArray($data);
}
