<?php
declare(strict_types=1);

use App\Application\Controllers\UserController;
use App\Application\Controllers\PlaylistController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) use ($app) {
        return $app->getContainer()->get('view')->render($response, 'Home.twig');
    });

    $app->group('/users', function (Group $group) {
        $group->get('', UserController::class . ':index');
        $group->get('/{id}', UserController::class . ':show');
    });

    $app->group('/playlists', function (Group $group) {
        $group->get('', PlaylistController::class . ':index');
        $group->get('/{id}', PlaylistController::class . ':show');
    });
};
