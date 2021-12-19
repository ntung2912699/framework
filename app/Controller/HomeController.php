<?php

namespace app\controller;

require '../vendor/autoload.php';
require '../libs/Controller.php';
require '../app/model/Users.php';

use app\model\Users;
use libs\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::queryAll($sql = "select * from users");
        return $users;
    }
}