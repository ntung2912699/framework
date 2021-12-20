<?php
namespace libs;

use app\Observers\QueryObservers;
use http\Message;
use libs\DBConnect;
use PDO;
use PDOException;
require '../libs/DBConnect.php';
require '../App/Observers/QueryObservers.php';

class BaseModels extends DBConnect{
    use QueryObservers;

    public $tableName;

    public $fillable_name;
    /*
     * @var DBConnect
     */
    protected $db;

    public function select($sql){
        $this->beforeSelect($sql);

        $this->query($sql);

        $this->afterSelect();
    }

//    public function query($sql){
//        $user = $this->db->query($sql);
//        echo $user;
//    }

    public function getdata(){
        try {

            $sql = $this->db->query("select * from $this->tableName");
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        }catch (PDOException $e){
            return 0;
        }
    }

    public function find($id){
        $sql = $this->db->query("select * from $this->tableName where id = $id");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function delete($id){
        $this->db->query("delete from $this->tableName where id = $id");
    }

    public function insert($data){
       if ($data != null){
           foreach ($data as $key=>$value){
              $column [] = $key;
              $valuedata[] = $value;
           }
           $columndata = implode(",",$column);
           $valuecolumn = implode("','",$valuedata);
           print_r($columndata . $valuecolumn);
           $this->db->query("INSERT INTO table_name ($columndata) VALUE ($valuecolumn)");
       }else{
           echo "data insert null";
       }
    }
}