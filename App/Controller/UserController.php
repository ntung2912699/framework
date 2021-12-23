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

    public function viewcreate(){
        return self::view('users/formcreate.php');
    }

    public function find($id = 1){
        $users = $this->userRepo->find($id);
        return self::view('index.php',['users'=>$users]);
    }
    public function create(){
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'roles' => $_REQUEST['roles']
        ];
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        $users = $this->userRepo->insertdata($data);
        return self::view('index.php',['users'=>$users]);;
    }
    public function update(){
        $id = 3;
        $data = [
            'name' => 'aaa',
            'email' => 'bbb@gmail.com',
            'password' => 'tkl12345',
            'roles' => 0
        ];
        $users = $this->userRepo->updatedata($data, $id);
        return $users;
    }
}