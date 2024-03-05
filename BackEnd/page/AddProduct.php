<?php
session_start();
require("../DataBase/DBCLass.php");
use DbClass\Table;

// Create a connection to the products table
$table = new Table("products");
$table->conn();

// Retrieve the uploaded file
$file = $_FILES["product_image"];

if ($_POST['category_id'] == "default") {
//    setcookie("message", "missing category", time() + 3600, '/'); // Set cookie before redirection
//    setcookie("color", "red", time() + 3600, '/');
    $_SESSION["message"] = "missing category";
    $_SESSION["color"] = "red";
    header("Location: ../AddProductForm.php");
    exit();
}

// Move the uploaded file to the appropriate directory
move_uploaded_file($file['tmp_name'], './product_images/' . $file['name']);

$postData = $_POST;
$postData['picture'] = $file['name'];

$table->Create($postData);


//setcookie("message", "successfully inserted", time() + 3600, '/');
//setcookie("color", "green", time() + 3600, '/');

$_SESSION["message"] = "successfully inserted";
$_SESSION["color"] = "green";


header("Location: ../AddProductForm.php");
exit(); // Make sure to exit after redirection

