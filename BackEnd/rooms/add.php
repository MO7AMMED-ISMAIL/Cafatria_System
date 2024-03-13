<?php 
include "../DataBase/DBCLass.php";
use DbClass\Table;
session_start();
$rooms = new Table('rooms');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!isset($_POST['token']) || !isset($_SESSION['token'])){
        exit('Token is not set');
        include "../404.html";
    }

    if($_POST['token'] == $_SESSION['token']){
        if(time() >= $_SESSION['token_expire']){
            exit('Token is Expired');
            include "../404.html";
        }
        unset($_SESSION['token']);
    }

    try{
        $roomNumber = $rooms->inputData($_POST['room_number']);
        $extraData = $rooms->inputData($_POST['ext']);
        
        $DataInsert = [
            'room_number'=>$roomNumber,
            'ext'=>$extraData,
        ];
        $rooms->Create($DataInsert);
        header("location: ../room.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("location: ../room.php?add=Room");
        exit();
    }
}else{
    header("Location: ../404.php");
}

?>