<?php
//namespace app\Controller;
//
//use app\Repositories\UserRepository;
//use libs\BaseResfulApi;
//
//require '../app/Repositories/UserRepository.php';
//require '../libs/BaseController.php';
//require '../libs/BaseResfulApi.php';
//
//class ApiUserController extends BaseResfulApi {
//    protected $userRepo;
//
//    public function __construct()
//    {
//        $this->userRepo = new UserRepository();
//    }
//
//    public function index(){
//        $users = $this->userRepo->getAll();
//        return $this->response(200,$users);
//    }
//}