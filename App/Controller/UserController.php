<?php
namespace app\Controller;
use app\Repositories\UserRepository;
use libs\BaseController;
use libs\BaseView;
require '../app/Repositories/UserRepository.php';
require '../libs/BaseController.php';

class UserController extends BaseController{

    protected $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function index(){
        $users = $this->userRepo->getAll();
        return self::view('index.php',['users'=>$users]);
    }

    public function find($id = 1){
        $users = $this->userRepo->find($id);
        return self::view('index.php',['users'=>$users]);
    }
    public function create(){
        $data =
        [
            'name' => 'abc',
            'email' => 'abc@gmail.com',
            'password' => 'abc12345',
            'roles' => 1
        ];
        $obj = $this->userRepo->insertdata($data);
        return $obj;
    }
    public function update(){
        $id = 3;
        $data = [
            'name' => 'bbb',
            'email' => 'bbb@gmail.com',
            'password' => 'tkl12345',
            'roles' => 0
        ];
        $users = $this->userRepo->updatedata($data, $id);
        return $users;
    }
}