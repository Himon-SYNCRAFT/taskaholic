<?php

namespace Taskaholic\Core\Domain\UseCase\FindUsers;

use Taskaholic\Core\Domain\Repository\UserRepositoryInterface;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersRequest;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersResponse;


class FindUsersUseCase
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(FindUsersRequest $request)
    {
        $filters = $request->getFilters();
        $users = $this->userRepository->find($filters);
        $request = new FindUsersResponse($users);

        return $request;
    }
}
