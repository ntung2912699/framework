<?php
namespace app\Controller;
use app\Repositories\UserRepository;
use libs\BaseController;
require '../app/Repositories/UserRepository.php';
require '../libs/BaseController.php';

class UserController extends BaseController {

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
        echo "Delete Complete user-id: $id <a href='/users/index'>Back Index</a>";
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
        $this->userRepo->insertdata($data);
        header('location:index');
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
        echo "update users $id successfuly <a href='/users/index'>back index</a>";
    }

    /*
     * api function response
     */

    public function api_index(){
        $users = $this->userRepo->getAll();
        return $this->response(200,$users);
    }

    public function api_find($id){
        $users = $this->userRepo->find($id);
        return $this->response(200,$users);
    }

    public function api_create(){
        $data = [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'password' => $_REQUEST['password'],
            'roles' => $_REQUEST['roles']
        ];
        $users = $this->userRepo->insertdata($data);
        return $this->response(201,$users);
    }
}