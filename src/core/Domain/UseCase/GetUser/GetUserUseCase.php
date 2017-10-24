<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Domain\ResponseFailure;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserResponse;


class GetUserUseCase
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(GetUserRequest $request)
    {
        $userId = $request->getUserId();
        $user = $this->userRepository->get($userId);
        $userNotFound = $user === null;

        if ($userNotFound) {
            $error = "User with id $userId not found";
            return new ResponseFailure($error);
        }

        $response = new GetUserResponse($user);
        return $response;
    }
}
