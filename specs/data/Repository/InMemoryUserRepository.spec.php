<?php

use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;


describe('InMemoryUserRepository', function() {
    beforeEach(function() {
        $this->repository = new InMemoryUserRepository([
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'user'],
        ]);
    });

    describe('->get()', function() {
        it('return proper User entity if given existing id', function() {
            $userId = 1;
            $user = $this->repository->get($userId);

            expect($user)->to->be
                ->instanceof('Taskaholic\Core\Domain\Entity\User');
            expect($user->toArray())->to->be
                ->equal(['id' => 1, 'name' => 'user']);
        });
    });

    describe('->find()', function() {
        it('return array of Users entities if match given filter', function() {
            $filter = [['parameter' => 'name', 'value' => 'user']];

            $users = $this->repository->find($filter);
            $usersArray = [];

            foreach ($users as $user) {
                $usersArray[] = $user->toArray();

                expect($user)->to->be
                    ->instanceof('Taskaholic\Core\Domain\Entity\User');
            }

            expect($usersArray)->to->be
                ->equal([
                    ['id' => 1, 'name' => 'user'],
                    ['id' => 2, 'name' => 'user'],
                ]);
        });
    });
});
