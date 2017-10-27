<?php

use \Psr\Http\Message\ResponseInterface as HttpResponse;
use \Psr\Http\Message\ServerRequestInterface as HttpRequest;

require 'vendor/autoload.php';

use Taskaholic\Core\Domain\UseCase\GetUser\GetUserRequest;
use Taskaholic\Core\Domain\UseCase\GetUser\GetUserUseCase;
use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;


$userRepository = new InMemoryUserRepository([
    ['id' => 1, 'name' => 'user'],
    ['id' => 2, 'name' => 'user2']
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

    if (!empty($data['id'])) {
        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $filter[] = ['parameter' => 'id', 'value' => $id];
    }

    if (!empty($data['name'])) {
        $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $filter[] = ['parameter' => 'name', 'value' => $name];
    }

    $users = $repository->find($filter);

    $httpResponse->getBody()->write(print_r($users, true));
});

$app->get('/users/{id}', function(HttpRequest $httpRequest, HttpResponse $httpResponse, $args) use ($userRepository) {
    $userId = (int)$args['id'] ?? null;

    $request = new GetUserRequest($userId);
    $useCase = new GetUserUseCase($userRepository);
    $response = $useCase->execute($request);

    $httpResponse->getBody()->write(print_r($response, true));
});

$app->get('/', function(HttpRequest $httpRequest, HttpResponse $httpResponse) {
    $httpResponse->getBody()->write('home');
});


$app->run();
