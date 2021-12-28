<?php
namespace app\Controller;

class AuthController extends UserController
{
    public function loginform(){
        return $this->view('auth/login');
    }
}