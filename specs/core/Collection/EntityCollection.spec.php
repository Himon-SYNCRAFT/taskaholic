<?php

use Taskaholic\Core\Collection\EntityCollection;
use Taskaholic\Core\Domain\Entity\User;


describe('EntityCollection', function() {
    beforeEach(function() {
        $this->users = [
            User::fromArray(['id' => 1, 'name' => 'user']),
            User::fromArray(['id' => 2, 'name' => 'user']),
        ];

        $this->collection = new EntityCollection(
            $this->users
        );
    });

    describe('->toArray()', function() {
        it('should return array with data from objects', function() {
            $users = $this->collection->toArray();

            expect($users)->to->equal([
                $this->users[0]->toArray(),
                $this->users[1]->toArray(),
            ]);
        });
    });

    describe('->toArray()', function() {
        it('should return array with entitites', function() {
            $itemsToArray = false;
            $users = $this->collection->toArray($itemsToArray);

            expect($users)->to->equal([
                $this->users[0],
                $this->users[1],
            ]);
        });
    });
});
