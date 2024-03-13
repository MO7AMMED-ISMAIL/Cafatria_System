<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;

if(!isset($_GET['order_id'])){
    header("location: ../404.php");
}

try{
    $id = $_GET['order_id'];
    
    $delUser = new Table('orders');
    $delUser->Delete("id = $id");
    header("location: ../order.php");
}catch(Exception $e){
    header("location: ../404.php");
}

?>