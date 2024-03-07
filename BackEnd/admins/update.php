<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;
session_start();
$update = new Table('admins'); 

// print_r($_POST);
// die();

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
        $img = $update->Upload($_FILES['img']);
        //update
        $DataUpdate = [
            "username"=>$username,
            "email"=>$email,
            "profile_picture"=>$img
        ];
        $updat = $update->Update($DataUpdate,'id',$id);
        header("location: ../admin.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../admin.php?edit=$id");
        exit();
    }
    
}



?>