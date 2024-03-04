<?php 
include "../Database/DBCLass.php";
use DbClass\Table;
session_start();
$users = new Table('users');
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
        $username = $users->isValidUsername($_POST['username']);
        $email = $users->ValidateEmail($_POST['email']);
        $room = $users->inputData($_POST['room']);
        $ext = $users->inputData($_POST['ext']);
        $img = $users->Upload($_FILES['img']);
        $password = $users->inputData($_POST['pass']);

        $DataInsert = [
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
            'profile_picture'=>$img,
            'room_number'=>$room,
            'extra_Number'=>$ext
        ];
        $users->Create($DataInsert);
        header("location: ../user.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("location: ../user.php?add=Users");
        exit();
    }
}

?>