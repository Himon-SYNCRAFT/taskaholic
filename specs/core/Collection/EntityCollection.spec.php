<?php

use Taskaholic\Core\Collection\EntityCollection;
use Taskaholic\Core\Domain\Entity\User;


describe('EntityCollection', function() {
    beforeEach(function() {
        $password = 'user';
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $this->users = [
            User::fromArray([
                'id' => 1,
                'name' => 'user',
                'passwordHash' => $passwordHash
            ]),

            User::fromArray([
                'id' => 2,
                'name' => 'user',
                'passwordHash' => $passwordHash
            ]),
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
