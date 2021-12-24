<?php
namespace libs;

use app\Observers\QueryObservers;
use http\Message;
use libs\DBConnect;
use PDO;
use PDOException;
require '../libs/DBConnect.php';
require '../app/Observers/QueryObservers.php';

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

    public function getAll(){
        try {

            $sql = $this->db->query("select * from $this->tableName");
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        }catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function find($id){
        try {
            $sql = $this->db->query("select * from $this->tableName where id = $id");
            $results = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        }catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function delete($id){
        try {
           return $this->db->query("delete from $this->tableName where id = $id");

        }catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function insert($data){
       if ($data != null){
           try {
               foreach ($data as $key=>$value){
                   $column [] = $key;
                   $valuedata[] = $value;
               }
               $columndata = implode(",",$column);
               $valuecolumn = implode("','",$valuedata);
               $valuecolumn = "'$valuecolumn'";
               $sql = "INSERT INTO $this->tableName ($columndata) VALUE ($valuecolumn)";
               $this->db->query($sql);
               echo "insert successfuly";
           }catch (\Exception $e){
               return $e->getMessage();
           }
       }else{
           echo "data insert null";
       }
    }

    public function update($data, $id){
        try {
            $sql = "UPDATE $this->tableName SET ";
            if ($data != null){
                foreach ($data as $key=>$value){
                    $sql .= "$key = '$value', ";
                }
                $sql = trim($sql, ", ");
                $sql .= " WHERE id = $id";
                $this->db->query($sql);
                echo "update successfuly";
            }else{
                echo "data update null";
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}