<?php 
include "../Database/DBCLass.php";
use DbClass\Table;
session_start();
$admins = new Table('admins');
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
        $username = $admins->isValidUsername($_POST['username']);
        $email = $admins->ValidateEmail($_POST['email']);
        $img = $admins->Upload($_FILES['img']);
        $password = $admins->inputData($_POST['pass']);

        $DataInsert = [
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
            'profile_picture'=>$img,
        ];
        $admins->Create($DataInsert);
        header("location: ../admin.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("location: ../Admin.php?add=Admin");
        exit();
    }
}

?>