<?php
namespace DbClass;
require "connect.php";
use base\Database;
use Exception;
use PDOException;

class Table extends Database{
    public $TbName;
    public function conn(){
        $conn = parent::connect();
    }

    public function __construct($tableName){
        $this->TbName = $tableName;
    }

    public function Create(array $values){
        $keys = implode(',', array_keys($values));
        $placeholders = rtrim(str_repeat('?,', count($values)), ',');
        $sql = "INSERT INTO {$this->TbName} ({$keys}) VALUES ({$placeholders})";
        
        try {
            $stmt = parent::connect()->prepare($sql);
            $success = $stmt->execute(array_values($values));
            if (!$success) {
                throw new Exception("Failed to execute query.");
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception("PDO Error: " . $e->getMessage());
        }
    }

    public function Update(array $data, $cond, $value) {
        $cols = array();
        foreach ($data as $key => $val) {
            $cols[] = "$key = ?";
        }
        $sql = "UPDATE {$this->TbName} SET " .implode(', ', $cols). " WHERE $cond = ?";
        
        try {
            $stmt = parent::connect()->prepare($sql);
            $params = array_merge(array_values($data), [$value]);
            $success = $stmt->execute($params);
            if (!$success) {
                throw new Exception("Failed to execute query.");
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception("PDO Error: " . $e->getMessage());
        }
    }

    public function Select(array $columns, $condition=1){
        $statement = "SELECT " . implode(",", $columns) . " FROM {$this->TbName} WHERE $condition";

        try {
            $selected = parent::connect()->query($statement);
            if($selected->rowCount() <= 0){
                throw new Exception("Empty Data Base");
            }
            return $selected->fetchAll(\PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            throw new Exception("PDO Error: " . $e->getMessage());
        }
    }

    public function SelectInnerJoinTable($tableName,array $firstTableColumns,array $secondTableColumns,$condition){
        $firstRequiredColumns=array();
        $secondRequiredColumns=array();

        //first elements
        foreach ($firstTableColumns as $col){
            $firstRequiredColumns[]="$tableName"."."."$col";
        }
        //second elements
        foreach ($secondTableColumns as $col){
            $secondRequiredColumns[]="$this->TbName"."."."$col";
        }
        $statement="SELECT ".implode(",",$firstRequiredColumns).",".implode(",",$secondRequiredColumns)." FROM $this->TbName inner join $tableName on $condition";
        try {
            $selected=parent::connect()->query($statement);
            if(! $selected->rowCount()){
                throw new Exception("returned Data From Inner Join Is Empty...");
            }
        }catch (PDOException $e){
            throw new Exception("PDO Error: ". $e->getMessage() );
        }

    }

    public function Delete($condition){
        $statement="DELETE FROM $this->TbName where $condition";
        try {
            parent::connect()->query($statement);
        }catch (PDOException $e){
            throw new Exception("PDO Error: ".$e->getMessage());
        }
    }

}


?>