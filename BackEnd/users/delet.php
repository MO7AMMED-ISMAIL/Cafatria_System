<?php

include "../DataBase/DBCLass.php"; 
use DbClass\Table; 
$table = new DbClass\Table('users');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        
        $table->Delete("id = $id"); 
        header("Location:../users.php");
        exit(); 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "User ID is not provided.";
}
?>
