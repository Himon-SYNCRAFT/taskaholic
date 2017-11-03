<?php

use DusanKasan\Knapsack\Collection;
use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersRequest;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersResponse;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersUseCase;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersValidation;
use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;


$user1 = ['id' => 1, 'name' => 'user'];
$user2 = ['id' => 2, 'name' => 'user'];

describe('FindUsersUseCase', function() use ($user1, $user2) {
    beforeEach(function() use ($user1, $user2) {
        $this->userRepository = new InMemoryUserRepository([$user1, $user2]);
        $this->validation = new FindUsersValidation();
    });

    describe('->execute()', function() use ($user1, $user2) {
        it('should return list of users if given valid filter', function() use ($user1, $user2) {
            $useCase = new FindUsersUseCase(
                $this->userRepository,
                $this->validation
            );

            $filters = [
                ['parameter' => 'name', 'value' => 'user'],
            ];

            $request = new FindUsersRequest([
                'filters' => $filters
            ]);

            $response = $useCase->execute($request);

            expect($response->hasErrors())->to->be->false();
            expect($response->getData())->to->have->length(2);

            $users = Collection::from($response->getData());

            expect($users->contains($user1))->to->equal(true);
            expect($users->contains($user2))->to->equal(true);
        });

        it('should return response with errors if given invalid parameter', function() {
            $useCase = new FindUsersUseCase(
                $this->userRepository,
                $this->validation
            );

            $filters = [
                ['parameter' => 'asdfsf', 'value' => 'asdas'],
            ];

            $request = new FindUsersRequest([
                'filters' => $filters
            ]);

            $response = $useCase->execute($request);
            expect($response->hasErrors())->to->be->true();
        });

        it('should return response with errors if given invalid filter', function() {
            $useCase = new FindUsersUseCase(
                $this->userRepository,
                $this->validation
            );

            $filters = [
                ['param' => 'asdfsf', 'value' => 'asdas'],
            ];

            $request = new FindUsersRequest([
                'filters' => $filters
            ]);

            $response = $useCase->execute($request);
            expect($response->hasErrors())->to->be->true();

            $filters = [
                ['parameter' => 'asdfsf', 'val' => 'asdas'],
            ];

            $request = new FindUsersRequest([
                'filters' => $filters
            ]);

            $response = $useCase->execute($request);
            expect($response->hasErrors())->to->be->true();
        });
    });
});
