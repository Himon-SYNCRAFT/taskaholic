<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersRequest;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersResponse;
use Taskaholic\Core\Domain\Validation\ValidationInterface;


class FindUsersUseCase
{
    protected $userRepository;
    protected $validation;

    public function __construct(UserRepositoryInterface $userRepository, ValidationInterface $validation)
    {
        $this->userRepository = $userRepository;
        $this->validation = $validation;
    }

    public function execute(FindUsersRequest $request)
    {
        if (!$this->validation->validate($request)) {
            $response = new FindUsersResponse();
            $response->addError($this->validation->getErrors());
            return $response;
        }

        $filters = $request->getFilters();
        $users = $this->userRepository->find($filters);
        $request = new FindUsersResponse($users);

        return $request;
    }
}
