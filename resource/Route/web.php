<?php
use app\Controller\UserController;
use FastRoute\Route;
use libs\RequestCore;
use libs\BaseRouter;

require '../vendor/autoload.php';
require '../libs/BaseRouter.php';
require '../app/Controller/UserController.php';
require '../libs/RequestCore.php';

BaseRouter::get('/users/index', 'UserController@index');

BaseRouter::get('/users/create', 'UserController@viewcreate');
BaseRouter::post('/users/up_created', 'UserController@create');

BaseRouter::get('/users/edit/{id}', 'UserController@edit');
BaseRouter::post('/users/update/{id}', 'UserController@update');

BaseRouter::get('/users/find/{id}', 'UserController@find');

BaseRouter::get('/users/delete/{id}', 'UserController@delete');

$router = new BaseRouter();

try {
    $route = $router->getRoute();
} catch (\Exception $e) {
    echo $e->getMessage();
    exit();
}

$route = $router->matchController();