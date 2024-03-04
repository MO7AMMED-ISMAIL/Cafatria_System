<?php
include "../database/DBClass.php";
use DbClass\Table;


if(!isset($_GET['admin_id'])){
    header("location: ../Admin.php");
}

try{
    $id = $_GET['admin_id'];
    $delAdmin = new Table('admins');
    $delAdmin->Delete("id = $id");
    header("location: ../Admin.php");
}catch(Exception $e){
    header("location: ../404.html");
}

?>