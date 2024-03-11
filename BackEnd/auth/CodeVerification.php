<?php
session_start();

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

    $code= $_POST['code'];

    if($_SESSION['code'] == $code){
        unset($_SESSION['checkCode']);
        header("Location: ./resetPassword.php?reset");
    }else{
        $_SESSION['checkCode'] = "The code you entered is not valid";
        header("Location: ./checkCodeForm.php");
    }

}

?>