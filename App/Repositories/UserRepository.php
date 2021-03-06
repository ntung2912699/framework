<?php
namespace app\Repositories;
use app\Models\User;
require '../app/Models/User.php';

class UserRepository{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function sqlquery($sql){
       return $this->model->query($sql);
    }

    public function getAll(){
        return $this->model->getAll();
    }

    public function find($id){
       return $this->model->find($id);
    }

    public function delete($id){
        return $this->model->delete($id);
    }

    public function insertdata($data){
        return $this->model->insert($data);
    }

    public function updatedata($data, $id){
        return $this->model->update($data, $id);
    }

}