<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;
session_start();
$update = new Table('users'); 

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
        $username = $update->isValidUsername($_POST['username']);
        $email = $update->ValidateEmail($_POST['email']);
        $room_id = $update->inputData($_POST['room_id']);
        $ext = $update->inputData($_POST['ext']);
        $img = $update->Upload($_FILES['img']);
        //update
        $DataUpdate = [
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
            'profile_picture'=>$img,
            'room_id'=>$room_id,
            'extra_Number'=>$ext
        ];
        $updat = $update->Update($DataUpdate,'id',$id);
        header("location: ../user.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../user.php?edit=$id");
        exit();
    }
    
}else{
    header("location: ../404.php");
}



?>