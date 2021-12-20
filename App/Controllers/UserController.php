<?php
namespace app\Controllers;

use app\Repositories\UserRepository;
use libs\BaseController;
use libs\BaseView;

require '../App/Repositories/UserRepository.php';
require '../libs/BaseController.php';

class UserController extends BaseController{

    protected $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function index(){
        $users = $this->userRepo->getAll();
        return self::view('index.php', $users);
    }

    public function find($id=1){
        $users = $this->userRepo->find($id);
        print_r("finid");
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