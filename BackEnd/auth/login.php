<?php
session_start();
include "../DataBase/DBCLass.php";
use DbClass\Table;

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
    
    $admins = new Table('admins');
    try{
        $email = $admins->ValidateEmail($_POST['email']);
        $password = $admins->inputData($_POST['pass']);
        
        $col = ['id','email', 'password'];
        $cod = "email='$email' AND password='$password'";
        $admin = $admins->Select($col,$cod);
        $admin = $admin->fetch(\PDO::FETCH_ASSOC);
        $_SESSION['id'] = $admin['id'];
        header("location: ../index.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = " email or password is incorrect";
        header("location: LoginForm.php");
        exit();
    }

}

?>