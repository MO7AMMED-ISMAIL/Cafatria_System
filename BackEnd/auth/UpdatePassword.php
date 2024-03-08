<?php
session_start();
include "../DataBase/DBCLass.php";
use DbClass\Table;
$admins = new Table('admins');


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!isset($_POST['token']) || !isset($_SESSION['token'])){
        exit('Token is not set');
        include "../404.html";
    }

    if($_POST['token'] == $_SESSION['token']){
        if(time() >= $_SESSION['token_expire']){
            exit('Token expired');
            include "../404.html";
        }
        unset($_SESSION['token']);
    }

    try{
        if(strlen($_POST['password']) < 8){
            throw new Exception("Password must be at least 8 characters");
        }
        $password = $admins->inputData($_POST['password']);
        $repeatPassword = $admins->inputData($_POST['repeatPassword']);
        $email = $_SESSION['email'];
        if($password != $repeatPassword){
            throw new Exception("The password is not Indicated");
        }

        $dataUpdate=[
            'password' => $password,
        ];
        $admins->Update($dataUpdate,'email',$email);
        unset($_SESSION['email']);
        header("Location: ./loginForm.php");
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ./resetPassword.php");
        exit();
    }
}
?>