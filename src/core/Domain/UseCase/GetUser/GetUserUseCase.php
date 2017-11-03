<?php

namespace Taskaholic\Core\Domain\UseCase\GetUser;

use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Domain\ResponseFailure;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserResponse;
use Taskaholic\Core\Domain\Validation\ValidationInterface;


class GetUserUseCase
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, ValidationInterface $validation = null)
    {
        $this->userRepository = $userRepository;
        $this->validation = $validation;
    }

    public function execute(GetUserRequest $request)
    {
        $userId = $request->getUserId();

        if (!$this->validation->validate($userId)) {
            $response = new GetUserResponse();

            foreach ($this->validation->getErrors() as $error) {
                $response->addError($error);
            }

            return $response;
        }

        $user = $this->userRepository->get($userId);
        $userNotFound = $user === null;

        if ($userNotFound) {
            $error = "User with id $userId not found";
            $response = new GetUserResponse();
            $response->addError($error);
            return $response;
        }

        $response = new GetUserResponse($user);
        return $response;
    }
}
