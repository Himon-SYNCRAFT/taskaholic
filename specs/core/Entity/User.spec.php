<?php

use Taskaholic\Core\Domain\Entity\User;

describe('User', function() {
    describe('constructor', function() {
        it('create proper object with id', function() {
            $userId = 1;
            $name = 'user';
            $user = new User($name, $userId);

            $userArray = $user->toArray();

            expect($userArray)->to->equal([
                'id' => $userId,
                'name' => $name,
            ]);
        });

        it('create proper object without id', function() {
            $name = 'user';
            $user = new User($name);

            $userArray = $user->toArray();

            expect($userArray)->to->equal([
                'id' => null,
                'name' => $name,
            ]);
        });
    });

    describe('toArray', function() {
        it('return array with all properties', function() {
            $userId = 1;
            $name = 'name';
            $user = new User($name, $userId);

            $userArray = $user->toArray();

            expect($userArray)->to->equal([
                'id' => $userId,
                'name' => $name,
            ]);
        });
    });
});
