<?php

namespace Taskaholic\Core\Collection;

use Taskaholic\Core\Domain\Entity\EntityInterface;


interface CollectionInterface
{
    public function filter(callable $function = null);
    public function has(callable $function = null);
    public function toArray($itemsToArray = true);
    public function every(callable $function);
    public function contains(EntityInterface $needle);
    public function length();
}
