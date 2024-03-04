<?php
include "../database/DBClass.php";
use DbClass\Table;

if(!isset($_GET['user_id'])){
    header("location: ../user.php");
}

try{
    $id = $_GET['user_id'];
    
    $delUser = new Table('users');
    $delUser->Delete("id = $id");
    header("location: ../user.php");
}catch(Exception $e){
    header("location: ../404.html");
}

?>