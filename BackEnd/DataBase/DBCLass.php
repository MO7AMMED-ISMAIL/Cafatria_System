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
        $sql = "UPDATE {$this->TbName} SET " . implode(', ', $cols) . " WHERE $cond = ?";
        
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
}

// $db = new Table('admins');
// //id	username	email	password
// $array = [
//     "username"=>"mohmaed isamil",
//     "email"=>"mo7ismai@gmail.com",
//     "password"=>"145563"
// ];

// $db->Update($array,'id',1);

?>