<?php


use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserUseCase;


describe('GetUserUseCase', function() {
    describe('->execute()', function() {
        beforeEach(function() {
            $this->userRepository = $this->getProphet()->prophesize(
                'Taskaholic\Core\Domain\Repository\UserRepositoryInterface'
            );
        });

        it('should return an response object', function() {
            $userId = 1;
            $user = new User($userId);
            $this->userRepository->get($userId)->willReturn($user);

            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase($this->userRepository->reveal());
            $response = $useCase->execute($request);

            expect($response->getUser()->id)->to->equal($user->getId());
        });
    });
});
