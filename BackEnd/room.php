<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: Auth/LoginForm.php");
}
include "DataBase/DBCLass.php";
use DbClass\Table;
$roomTable = new Table('rooms');
$current = 'Room';
$id = 1 ;
$rooms = $roomTable->Select(['*']);
include "include/sidebar.php";
include "include/navbar.php";

if(isset($_GET['add']) == 'Admin'){
    include "rooms/addForm.php";
}
elseif(isset($_GET['edit'])){
    $RoomId = $_GET['edit'];
    $SelRoom = $roomTable->FindById('id',$RoomId);
    include "rooms/editForm.php";
}else{
    include "rooms/table.php";
}

include "include/footer.php";

?>