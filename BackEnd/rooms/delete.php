<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;


if(!isset($_GET['id'])){
    header("Location: ../404.php");
}

try{
    $id = $_GET['id'];
    $delRoom = new Table('rooms');
    $delRoom->Delete("id = $id");
    header("location: ../room.php");
}catch(Exception $e){
    header("location: ../404.php");
}

?>