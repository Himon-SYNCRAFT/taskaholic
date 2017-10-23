<?php


use Taskaholic\Core\Domain\Request\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUserUseCase;


describe('GetUserUseCase', function() {
    describe('->execute()', function() {
        beforeEach(function() {
            $this->userRepository = $this->getProphet()->prophesize(
                'Taskaholic\Core\Domain\Repository\UserRepositoryInterface'
            );
        });

        it('should return an User object', function() {
            $user = [
                'userId' => 1
            ];
            $this->userRepository->get($user['userId'])->willReturn($user);

            $request = new GetUserRequest($user['userId']);
            $useCase = new GetUserUseCase($this->userRepository->reveal());
            $response = $useCase->execute($request);

            expect($response->getUser())->to->equal($user);
        });
    });
});
