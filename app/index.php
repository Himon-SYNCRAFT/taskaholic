<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

use Taskaholic\Data\Repository\InMemory\InMemoryUserRepository;

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

$app = new \Slim\App($config);
$app->get('/', function(Request $request, Response $response) {
    $repository = new InMemoryUserRepository([
        ['id' => 1, 'name' => 'user']
    ]);

    $user = $repository->get(1);

    $response->getBody()->write(print_r($user, true));
    return $response;
});

$app->get('/users/find', function(Request $request, Response $response){
    $data = $request->getParsedBody();

    foreach ($request->getQueryParams() as $key => $param) {
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

    $repository = new InMemoryUserRepository([
        ['id' => 1, 'name' => 'user'],
        ['id' => 2, 'name' => 'user2']
    ]);

    $users = $repository->find($filter);

    $response->getBody()->write(print_r($users, true));
});

$app->get('/users/{id}', function(Request $request, Response $response, $args){
    $userId = (int)$args['id'] ?? null;

    $repository = new InMemoryUserRepository([
        ['id' => 1, 'name' => 'user'],
        ['id' => 2, 'name' => 'user2']
    ]);

    $user = $repository->get($userId);

    $response->getBody()->write(print_r($user, true));
});


$app->run();
