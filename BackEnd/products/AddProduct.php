<?php
session_start();
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
        $table = new Table("products");
// Retrieve the uploaded file
        $file = $_FILES["product_image"];

        if ($_POST['category_id'] == "default") {
//    setcookie("message", "missing category", time() + 3600, '/'); // Set cookie before redirection
//    setcookie("color", "red", time() + 3600, '/');
            $_SESSION["message"] = "missing category";
            $_SESSION["color"] = "red";
            header("Location: ../products.php?add=product");
            exit();
        }

// Move the uploaded file to the appropriate directory
        move_uploaded_file($file['tmp_name'], '../uploads/' . $file['name']);

        $postData = $_POST;
        unset($postData['token']);
        $postData['picture'] = $file['name'];

        $table->Create($postData);


//setcookie("message", "successfully inserted", time() + 3600, '/');
//setcookie("color", "green", time() + 3600, '/');

        $_SESSION["message"] = "Product Added successfully";
        $_SESSION["color"] = "green";


        header("Location: ../products.php");
        exit(); // Make sure to exit after redirection

    }catch (Exception $e) {
        $_SESSION["message"] = $e->getMessage();
        $_SESSION["color"] = "red";
        header("Location: ../products.php?add=product");
        exit();
    }catch(PDOException $e){
        $_SESSION["message"] = $e->getMessage();
        $_SESSION["color"] = "red";
        header("Location: ../products.php?add=product");
    }
}else{
    header("Location: ../404.php");
}