<?php
include "../database/DBClass.php";
use DbClass\Table;


if(!isset($_GET['id'])){
    header("location: ../admin.php");
}

try{
    $id = $_GET['id'];
    $delAdmin = new Table('admins');
    $delAdmin->Delete("id = $id");
    header("location: ../admin.php");
}catch(Exception $e){
    header("location: ../404.html");
}

?>