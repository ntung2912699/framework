<?php
use app\Controller\UserController;
use FastRoute\Route;

require '../vendor/autoload.php';
require '../libs/BaseRouter.php';
require '../app/Controller/UserController.php';

$router = new libs\BaseRouter();

$router->register('get','/users/index',[\app\controller\UserController::class,'index']);

$router->register('get','/users/home',[\app\controller\UserController::class,'index']);
$router->register('get','/users/detail/1',[\app\controller\UserController::class,'find']);
$router->register('get','/users/update/1',[\app\controller\UserController::class,'update']);
$router->register('get','/users/create',[\app\controller\UserController::class,'viewcreate']);
$router->register('get','/users/store',[\app\controller\UserController::class,'create']);

$route = $router->getRouter();

$controller = new $route['controller'];
$action = $route['action'];

call_user_func_array([$controller,$action],$route['params']);