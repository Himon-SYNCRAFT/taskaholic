<?php


use Taskaholic\Core\Domain\Entity\User;
use Taskaholic\Core\Domain\ResponseFailure;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserUseCase;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserValidation;


describe('GetUserUseCase', function() {
    describe('->execute()', function() {
        beforeEach(function() {
            $this->userRepository = $this->getProphet()->prophesize(
                'Taskaholic\Core\Domain\Repository\UserRepositoryInterface'
            );

            $this->validation = new GetUserValidation();
        });

        it('should return successfull response if object was found', function() {
            $userId = 1;
            $user = new User($userId);
            $this->userRepository->get($userId)->willReturn($user);

            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase(
                $this->userRepository->reveal(),
                $this->validation
            );
            $response = $useCase->execute($request);

            expect($response->getData()['id'])->to->equal($user->getId());
        });

        it('should return response with errors if object was not found', function(){
            $userId = 1;
            $this->userRepository->get($userId)->willReturn(null);

            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase(
                $this->userRepository->reveal(),
                $this->validation
            );
            $response = $useCase->execute($request);

            expect($response->getErrors())->to->equal(["User with id $userId not found"]);
        });

        it('should return response with error if userId is not an integer', function() {
            $userId = 'abc';
            $request = new GetUserRequest($userId);
            $useCase = new GetUserUseCase(
                $this->userRepository->reveal(),
                $this->validation
            );
            $response = $useCase->execute($request);

            expect($response->hasErrors())->to->be->true();
            /* expect($response->getErrors())->to->equal(["userId: expected integer"]); */
        });
    });
});
