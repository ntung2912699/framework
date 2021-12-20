<?php
namespace app\Models;
use libs\BaseModels;
use libs\DBConnect;

require '../libs/BaseModels.php';

class User extends BaseModels{

    protected $table = "users";

    protected $fillable = ['id','name','email','password','roles'];

    public function __construct()
    {
        $this->tableName = $this->table;
        $this->fillable_name = $this->fillable;
        $this->db = DBConnect::getConnect();
    }
}