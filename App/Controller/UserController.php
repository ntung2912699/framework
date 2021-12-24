<?php
namespace app\Controller;
use app\Repositories\UserRepository;
use libs\BaseController;
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
        return $this->view('/users/index',['users'=>$users]);
    }

    public function find($id){
        $users = $this->userRepo->find($id);
        return self::view('users/index',['users'=>$users]);
    }

    public function delete($id){
        $users = $this->userRepo->delete($id);
        echo "xoa xong $id <a href='/users/index'>Ve Trang Chu</a>";
    }

    public function viewcreate(){
        return self::view("users/formcreate");
    }

    public function create()
    {
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'roles' => $_REQUEST['roles']
        ];
        $users = $this->userRepo->insertdata($data);
        return readlink('/users/index');
    }

    public function edit($id){
        $users = $this->userRepo->find($id);
        return self::view("users/editform",['users'=>$users]);
    }
    public function update($id){
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'roles' => $_REQUEST['roles']
        ];
        $this->userRepo->updatedata($data, $id);

        return realpath('/users/index');
    }
}