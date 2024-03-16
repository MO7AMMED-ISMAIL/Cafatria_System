<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;
session_start();
$update = new Table('rooms');


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!isset($_POST['token']) || !isset($_SESSION['token'])){
        exit('Token is not set');
    }
    if($_POST['token'] == $_SESSION['token']){
        if(time() >= $_SESSION['token_expire']){
            exit('Token is Expired');
        }
        unset($_SESSION['token']);
    }
    
    //validation
    try{
        
        $id = $update->inputData($_POST['id']);
        $roomNumber = $update->inputData($_POST['room_number']);
        $extraData = $update->inputData($_POST['ext']);
        //update
        $DataUpdate = [
            "room_number"=>$roomNumber,
            "ext"=>$extraData,
        ];
        $updat = $update->Update($DataUpdate,'id',$id);
        $_SESSION['success'] = 'Room Updated Successfully';

        header("location: ../room.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../room.php?edit=$id");
        exit();
    }
    
}else{
    header("Location: ../404.php");
}



?>