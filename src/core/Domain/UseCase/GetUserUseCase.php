<?php

namespace Taskaholic\Core\Domain\UseCase;

use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Domain\Request\GetUserRequest;
use Taskaholic\Core\Domain\Response\GetUserResponse;


class GetUserUseCase
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(GetUserRequest $request)
    {
        $userId = $request->getUserId();
        $user = $this->userRepository->get($userId);
        $response = new GetUserResponse($user);
        return $response;
    }
}
