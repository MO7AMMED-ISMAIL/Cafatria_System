<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        session_destroy();
        session_unset();
        header("location: ./loginForm.php");
        exit();
    }else{
        header("Location: ../404.html");
    }
?>