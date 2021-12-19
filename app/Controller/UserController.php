<?php
namespace app\Controller;
use app\Repositories\UserRepository;
require '../app/Repositories/UserRepository.php';

class UserController{

    protected $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function index(){
        $users = $this->userRepo->getAll();
        return $users;
    }

    public function create($data=
       [
           'id' => '2',
           'name' => 'abc',
           'email' => 'abc@gmail.com',
           'password' => 'abc12345',
       ])
    {
        $obj = $this->userRepo->insertdata($data);
        return $obj;
    }
//    public function sql_query(){
//        $users = $this->userRepo->sqlquery("select * from user");
//        return $users;
//    }
}