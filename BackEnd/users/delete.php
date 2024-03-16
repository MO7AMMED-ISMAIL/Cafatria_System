<?php
session_start();
include "../DataBase/DBCLass.php"; 
use DbClass\Table; 
$table = new DbClass\Table('users');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        
        $table->Delete("id = $id");
        $_SESSION["success"]="User Deleted Successfully";
        header("Location:../users.php");
        exit(); 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../404.php");
}
?>
