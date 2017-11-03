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
    protected $validation;

    public function __construct(UserRepositoryInterface $userRepository, ValidationInterface $validation)
    {
        $this->userRepository = $userRepository;
        $this->validation = $validation;
    }

    public function execute(GetUserRequest $request)
    {
        if (!$this->validation->validate($request)) {
            $response = new GetUserResponse();
            $response->addError($this->validation->getErrors());
            return $response;
        }

        $userId = $request->getUserId();

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
