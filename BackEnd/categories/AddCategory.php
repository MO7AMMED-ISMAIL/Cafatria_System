<?php
session_start();
$from=$_SESSION['from'];
unset($_SESSION['from']);
require("../DataBase/DBCLass.php");

use DbClass\Table;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
            exit('Token is not set');
            include "../404.php";
        }

        if ($_POST['token'] == $_SESSION['token']) {
            if (time() >= $_SESSION['token_expire']) {
                exit('Token is Expired');
                include "../404.php";
            }
            unset($_SESSION['token']);
        }

// Create a connection to the products table
        $table = new Table("categories");
        unset($_POST['token']);
        $table->Create($_POST);

//successfully created
        if ($from == "product") {
            $_SESSION['message']="New Category Added";
            $_SESSION["color"]="green";
            header("Location:../products.php?add=product");
        } else {
            $_SESSION['message']="Successfully inserted";
            $_SESSION["color"]="green";
            header("Location:../categories.php");
        }
    }catch (Exception $e) {
        $_SESSION["message"] = $e->getMessage();
        $_SESSION["color"] = "red";
        header("Location: ../categories.php?add=category");
        exit();
    }catch(PDOException $e){
        $_SESSION["message"] = $e->getMessage();
        $_SESSION["color"] = "red";
        header("Location: ../categories.php?add=category");
    }
}else{
    header("Location: ../404.php");
}