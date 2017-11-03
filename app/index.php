<?php

use \Psr\Http\Message\ResponseInterface as HttpResponse;
use \Psr\Http\Message\ServerRequestInterface as HttpRequest;

require 'vendor/autoload.php';

use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersRequest;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersUseCase;
use Taskaholic\Core\Domain\UseCase\FindUsers\FindUsersValidation;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserUseCase;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserValidation;
use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;


$userRepository = new InMemoryUserRepository([
    ['id' => 1, 'name' => 'user'],
    ['id' => 2, 'name' => 'user']
]);

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

$app = new \Slim\App($config);

$app->get('/users/find', function(HttpRequest $httpRequest, HttpResponse $httpResponse) use ($userRepository) {
    $data = $httpRequest->getParsedBody();

    foreach ($httpRequest->getQueryParams() as $key => $param) {
        $data[$key] = $param;
    }

    $filter = [];

    foreach ($data as $key => $value) {
        $filter[] = ['parameter' => $key, 'value' => $value];
    }

    $request = new FindUsersRequest([
        'filters' => $filter
    ]);
    $useCase = new FindUsersUseCase(
        $userRepository,
        new FindUsersValidation()
    );
    $response = $useCase->execute($request);

    if ($response->hasErrors()) {
        return $httpResponse->withJson($response->getErrors());
    }

    $users = $response->getData();

    return $httpResponse->withJson($users);
});

$app->get('/users/{id}', function(HttpRequest $httpRequest, HttpResponse $httpResponse, $args) use ($userRepository) {
    $userId = (int)$args['id'] ?? null;

    $request = new GetUserRequest($userId);
    $useCase = new GetUserUseCase(
        $userRepository,
        new GetUserValidation()
    );
    $response = $useCase->execute($request);

    if ($response->hasErrors()) {
        return $httpResponse->withJson($response->getErrors());
    }

    $user = $response->getData();

    return $httpResponse->withJson($user);
});

$app->get('/', function(HttpRequest $httpRequest, HttpResponse $httpResponse) {
    $httpResponse->getBody()->write('home');
});


$app->run();
