<?php

use Taskaholic\Core\Collection\Collection;
use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersRequest;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersResponse;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersUseCase;
use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;

$user1 = ['id' => 1, 'name' => 'user'];
$user2 = ['id' => 2, 'name' => 'user'];

describe('FindUsersUseCase', function() use ($user1, $user2) {
    beforeEach(function() use ($user1, $user2) {
        $this->userRepository = new InMemoryUserRepository([$user1, $user2]);
    });

    describe('->execute()', function() use ($user1, $user2) {
        it('should return list of users if given valid filter', function() use ($user1, $user2) {
            $useCase = new FindUsersUseCase($this->userRepository);
            $filters = [
                ['parameter' => 'name', 'value' => 'user'],
            ];

            $request = new FindUsersRequest($filters);

            $response = $useCase->execute($request);
            $users = $response->getUsers();

            expect($users->every(function($user) {
                return $user instanceof User;
            }))->to->equal(true);

            expect($users->contains(User::fromArray($user1)))->to->equal(true);
            expect($users->contains(User::fromArray($user2)))->to->equal(true);
        });
    });
});
