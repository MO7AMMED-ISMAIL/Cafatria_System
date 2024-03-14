<?php
session_start();
require("../DataBase/DBCLass.php");
use DbClass\Table;



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
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
        $table->conn();

// Retrieve the uploaded file
        $file = $_FILES["product_image"];


        move_uploaded_file($file['tmp_name'], '../uploads/' . $file['name']);


        $postData = [];

        foreach ($_POST as $key => $data) {
            if ($key != "id")
                $postData[$key] = $data;
        }

        $postData['picture'] = $file['name'];

        $table->Update($postData, "id", $_POST['id']);
        //successfully updated
        header("Location:../products.php");
    }
catch (Exception $e){
    $_SESSION['error']="error while update please try again";
    $_SESSION['color']="red";
    header("../products.php?edit={$_POST['id']}");
}
}else{
        header("Location: ../404.php");
}
