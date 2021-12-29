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
BaseRouter::get('/users/create', 'UserController@viewcreate');
BaseRouter::post('/users/up_created', 'UserController@create');
BaseRouter::get('/users/edit/{id}', 'UserController@edit');
BaseRouter::post('/users/update/{id}', 'UserController@update');
BaseRouter::get('/users/find/{id}', 'UserController@find');
BaseRouter::get('/users/delete/{id}', 'UserController@delete');

/*
 * api router
 */

BaseRouter::get('/api/users/index', 'UserController@api_index');
BaseRouter::get('/api/users/find/{id}', 'UserController@api_find');
BaseRouter::post('/api/users/create', 'UserController@api_create');

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

$route = $router->matchController();