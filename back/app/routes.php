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
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
}

return function (App $app) {

    $mf = new mf;

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return cors($response);
    });

    $app->post('/login', function (Request $request, Response $response, $args) use ($mf) {
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

    $app->post('/authorize', function (Request $request, Response $response, $args) use ($mf) {
        $data = $request->getParsedBody();
        try {
          $result = $mf->User()->authorize($data['user_id'], $data['authCode']);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->post('/registration', function (Request $request, Response $response, $args) use ($mf) {
        $data = $request->getParsedBody();
        try {
          $result = $mf->User()->registration($data);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->get('/comments', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        try {
          $result = $mf->Comments()->getComments();
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->post('/comments', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        $data = $request->getParsedBody();
        try {
          $result = $mf->Comments()->insertComment($user->id, $data['comment'], $data['media']);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->get('/detect-url', function (Request $request, Response $response, $args) use ($mf) {
        $url = $request->getQueryParams()['url'] ?? null;
        if (!$url) {
          return cors($response->withStatus(400));
        }
        $type = get_headers($url, true)['Content-Type'];
        if (is_array($type)) {
          $type = reset($type);
        }
        if (preg_match('/image/', $type)) {
          $data = file_get_contents($url);
          $result = [
            'type' => 'image',
            'content' => 'data:' . $type . ';base64,' . base64_encode($data)
          ];
        } else if (preg_match('/youtu\.?be/', $url)) {
          $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
          if (preg_match($regExp, $url, $data)) {
            $result = [
              'type' => 'youtube',
              'content' => $data[7],
            ];
          } else {
            $result = ['type' => null ];
          }
        } else {
          $result = ['type' => null ];
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->get('/video/{video}', function (Request $request, Response $response, $args) use ($mf) {
        try {
          $video = file_get_contents(__DIR__ . '/video/' . $args['video'] . '.mp4');
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write($video);
        return cors($response->withStatus(200)->withHeader('Content-type', 'video/mp4'));
    });

    $app->get('/image/{image}', function (Request $request, Response $response, $args) use ($mf) {
        $filename = __DIR__ . '/image/' . $args['image'];
        try {
          $image = file_get_contents($filename);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $typeInt = exif_imagetype($filename);
        $response->getBody()->write($image);
        return cors($response->withStatus(200)->withHeader('Content-type', image_type_to_mime_type($typeInt)));
    });

    $app->post('/likes', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        $data = $request->getParsedBody();
        try {
          $result = $mf->Likes()->postLike($data['comment_id'], $user->id);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));  
        }
        $response->getBody()->write(json_encode([ 
          'comment_id' => intval($data['comment_id']), 
          'like' => $result,
        ]));
        return cors($response->withStatus(201));
    });

    $app->delete('/likes/{commentId}', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        try {
          $mf->Likes()->deleteLike($args['commentId'], $user->id);
        } catch (\Exception $e) {
          $response->getBody()->write(json_encode($e));
          return cors($response->withStatus(400));  
        }
        $response->getBody()->write(json_encode([ 
          'comment_id' => intval($args['commentId']), 
          'user_id' => $user->id
        ]));
        return cors($response->withStatus(200));
    });

    $app->get('/profile', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        try {
          $result = $mf->User()->loadProfile($user->id);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });

    $app->put('/profile', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        $data = $request->getParsedBody();
        try {
          $result = $mf->User()->saveProfile($user->id, $data['firstname'], $data['lastname']);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));  
        }
        return cors($response->withStatus(204));
    });

    $app->put('/activate-two-factor', function (Request $request, Response $response, $args) use ($mf) {
        $authToken = $request->getHeader('Authorization')[0] ?? null;
        $user = $mf->User()->getUser($authToken);
        if (!$user) {
          return cors($response->withStatus(401));
        }
        try {
          $result = $mf->User()->activateTwoFactor($user->id);
        } catch (\Exception $e) {
          $response->getBody()->write($e->getMessage());
          return cors($response->withStatus(400));  
        }
        $response->getBody()->write(json_encode($result));
        return cors($response->withStatus(200));
    });


};
