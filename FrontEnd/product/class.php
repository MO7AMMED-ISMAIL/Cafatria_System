<?php
namespace DbClass;
require "connect.php";
use base\Database;
use Exception;
use PDOException;

class Table extends Database{
    public $TbName;
    private $conn;
    public function conn(){
        $this->conn = parent::connect();
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
            return parent::connect()->lastInsertId();
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
            return $selected;
        } catch (PDOException $e){
            throw new Exception("PDO Error: " . $e->getMessage());
        }
    }

    public function FindById($cond,$value){
        $sql = "SELECT * FROM {$this->TbName} WHERE $cond = :val";
        $Sel = parent::connect()->prepare($sql);
        $Sel->execute(['val' => $value]);
        if($Sel->rowCount() > 0){
            $result = $Sel->fetch();
            return $result;
        }else{
            throw new Exception("is not Found");
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
        // echo $statement;
        try {
            $selected=parent::connect()->query($statement);
            if(! $selected->rowCount()){
                throw new Exception("returned Data From Inner Join Is Empty...");
            }
            return $selected;
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

    public function inputData($data) { 
        if(strlen($data) <= 0){
            throw new Exception("The input {$data} is empty");
        }
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data);  
        return $data;  
    }  

    public function ValidateEmail($data){
        if(filter_var($data, FILTER_VALIDATE_EMAIL)){
            return $data;
        }
        else{
            throw new Exception("is not valid Mail");
        }
    }

    public function isValidUsername($username){
        $pattern = '/^[a-zA-Z0-9_]{3,20}$/';
        if (!preg_match($pattern, $username)) {
            throw new Exception('Invalid username format.');
        }else{
            return $username;
        }
    }

    function Upload($image , $dir="../uploads/"){
        $dirFile = $dir;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    
        if (!empty($image['name'])) {
            $fileName = basename($image["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
            $newImage = uniqid() . "." . $fileType;
            $targetFilePath = $dirFile . $newImage;
    
            // Check if file size is less than 1MB
            if ($image['size'] < 5000000) {
                // Check if file type is allowed
                if (in_array($fileType, $allowTypes)) {
                    // Move uploaded file to target directory
                    if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                        return $newImage;
                    } else {
                        throw new Exception("Failed to upload image.");
                    }
                } else {
                    throw new Exception("Please choose a valid image file.");
                }
            } else {
                throw new Exception("File size is too large. Please upload a smaller file.");
            }
        } else {
            throw new Exception("No file uploaded.");
        }
    }

    public function rowCount($tableName){
        $sql = "Select COUNT(*) as count from $tableName ";
        try{
            $stmt = parent::connect()->query($sql);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['count'];
        }catch(Exception $e){
            throw new Exception("Not Found Table Name");
        }
    }
    
}


?>