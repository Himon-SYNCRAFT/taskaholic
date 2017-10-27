<?php

use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;

$user1 = ['id' => 1, 'name' => 'user'];
$user2 = ['id' => 2, 'name' => 'user'];

describe('InMemoryUserRepository', function() use ($user1, $user2) {
    beforeEach(function() use ($user1, $user2) {
        $this->repository = new InMemoryUserRepository([$user1, $user2]);
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

    describe('->find()', function() use($user1, $user2) {
        it('return collection of Users entities if match given filter', function() use($user1, $user2) {
            $filter = [
                ['parameter' => 'name', 'value' => 'user'],
                ['parameter' => 'id', 'value' => 1],
            ];

            $users = $this->repository->find($filter);

            expect($users->every(function($user) {
                return $user instanceof User;
            }));

            expect($users->length())->to->equal(1);
            expect($users->contains(User::fromArray($user1)))->to->equal(true);
            expect($users->contains(User::fromArray($user2)))->to->equal(false);
        });
    });
});
