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

    describe('checkPassword', function() {
        it('return true if password is correct', function() {
            $name = 'user';
            $password = 'user';
            $userId = 1;
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $user = new User($name, $userId, $passwordHash);

            expect($user->checkPassword($password))->to->be->true();
        });

        it('return false if password is incorrect', function() {
            $name = 'user';
            $password = 'user';
            $incorrectPassword = 'User';
            $userId = 1;
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $user = new User($name, $userId, $passwordHash);

            expect($user->checkPassword($incorrectPassword))->to->be->false();
        });
    });
});
