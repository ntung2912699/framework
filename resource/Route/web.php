<?php
use app\Controller\UserController;

require '../vendor/autoload.php';
require '../libs/BaseRouter.php';
require '../App/Controllers/UserController.php';

$router = new libs\BaseRouter();

$router->register('get','',[\App\controller\UserController::class,'index']);
$router->register('get','users/detail/1',[\App\controller\UserController::class,'find']);
$router->register('post','users/create',[\App\controller\UserController::class,'create']);


$route = $router->getRouter();

print_r($route);
$controller = new $route['controller'];
$action = $route['action'];
call_user_func_array([$controller,$action],$route['params']);
