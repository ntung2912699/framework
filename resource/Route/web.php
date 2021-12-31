<?php
use app\Controller\UserController;
use FastRoute\Route;
use libs\RequestCore;
use libs\BaseRouter;
use app\Middleware\LogMiddleware;

require '../vendor/autoload.php';
require '../libs/BaseRouter.php';
require '../app/Controller/UserController.php';
require '../libs/RequestCore.php';
require '../resource/Route/webApi.php';
require '../app/Middleware/LogMiddleware.php';
require '../app/Controller/Api/ApiUserController.php';
require '../app/Controller/Auth/AuthController.php';

/*
 * router user
 */
BaseRouter::get('/users/index', 'UserController@index');
BaseRouter::get('/users/create', 'UserController@viewcreate',[LogMiddleware::class]);
BaseRouter::post('/users/up_created', 'UserController@create',[LogMiddleware::class]);
BaseRouter::get('/users/edit/{id}', 'UserController@edit',[LogMiddleware::class]);
BaseRouter::post('/users/edit/{id}', 'UserController@update',[LogMiddleware::class]);
BaseRouter::get('/users/detail/{id}', 'UserController@find');
BaseRouter::get('/users/delete/{id}', 'UserController@delete',[LogMiddleware::class]);

/*
 * api router
 */

BaseRouter::get('/api/users/index', 'UserController@api_index');
BaseRouter::get('/api/users/find/{id}', 'UserController@api_find',[LogMiddleware::class]);
BaseRouter::post('/api/users/create', 'UserController@api_create',[LogMiddleware::class]);

/*
 * auth router
 */
BaseRouter::get('/login', 'AuthController@loginform');
BaseRouter::post('/checklogin', 'AuthController@checklogin');
BaseRouter::get('/logout', 'AuthController@logout');

$router = new BaseRouter();

try {
    $route = $router->getRoute();
} catch (\Exception $e) {
    echo $e->getMessage();
    exit();
}

$route = $router->match();