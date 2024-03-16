<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;


if(!isset($_GET['id'])){
    header("location: ../404.php");
}

try{
    $id = $_GET['id'];
    $delAdmin = new Table('admins');
    $delAdmin->Delete("id = $id");
    $checkAdmin=$delAdmin->Select(["*"]);

    $_SESSION['success'] = 'Admin Deleted Successfully';
    header("location: ../admin.php");
}catch(Exception $e){
    header("location: ../404.php");
}

?>