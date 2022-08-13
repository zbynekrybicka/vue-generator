<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Services\mf;

function cors($response) {
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
}

return function (App $app) {

    $mf = new mf;

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return cors($response);
    });

    $app->post('/login', function (Request $request, Response $response) use ($mf) {
        $data = $request->getParsedBody();
        try {
          $result = $mf->User()->login($data['username'], $data['password']);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });


};
