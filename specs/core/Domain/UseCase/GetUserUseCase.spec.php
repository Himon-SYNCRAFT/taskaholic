<?php


use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserUseCase;
use Taskaholic\Core\Domain\ResponseFailure;


describe('GetUserUseCase', function() {
    describe('->execute()', function() {
        beforeEach(function() {
            $this->userRepository = $this->getProphet()->prophesize(
                'Taskaholic\Core\Domain\Repository\UserRepositoryInterface'
            );
        });

        it('should return successfull response if object was found', function() {
            $userId = 1;
            $user = new User($userId);
            $this->userRepository->get($userId)->willReturn($user);

            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase($this->userRepository->reveal());
            $response = $useCase->execute($request);

            expect($response->getUser()['id'])->to->equal($user->getId());
        });

        it('should return ResponseFailure if object was not found', function(){
            $userId = 1;
            $this->userRepository->get($userId)->willReturn(null);

            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase($this->userRepository->reveal());
            $response = $useCase->execute($request);

            expect($response)->to->be->an->instanceof('Taskaholic\Core\Domain\ResponseFailure');
            expect($response->getErrors())->to->equal(["User with id $userId not found"]);
        });
    });
});
