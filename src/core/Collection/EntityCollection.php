<?php

namespace Taskaholic\Core\Collection;

use DusanKasan\Knapsack\Collection as KnapsackCollection;
use Taskaholic\Core\Collection\CollectionInterface;
use Taskaholic\Core\Domain\Entity\EntityInterface;

class EntityCollection implements CollectionInterface
{
    private $items;

    public function __construct($items)
    {
        $this->items = KnapsackCollection::from($items);
    }

    public function filter(callable $function = null)
    {
        return $this->items->filter($function);
    }

    public function has(callable $function = null)
    {
        return $this->filter($function)->isNotEmpty();
    }

    public function toArray($itemsToArray = true) {
        if ($itemsToArray) {
            return $this->items->map(function($item) {
                return $item->toArray();
            });
        }

        return $this->items->toArray();
    }

    public function every(callable $function) {
        return $this->items->every($function);
    }

    public function contains(EntityInterface $needle)
    {
        return $this->has(function($item) use ($needle) {
            return $item->toArray() == $needle->toArray();
        });
    }
}
