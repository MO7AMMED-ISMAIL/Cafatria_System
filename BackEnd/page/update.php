<?php
session_start();
require("../DataBase/DBCLass.php");
use DbClass\Table;

// Create a connection to the products table
$table = new Table("products");
$table->conn();

// Retrieve the uploaded file
$file = $_FILES["product_image"];


move_uploaded_file($file['tmp_name'], './product_images/' . $file['name']);


$postData=[];

foreach ($_POST as $key=>$data)
{
    if($key!="id")
        $postData[$key]=$data;
}

$postData['picture'] = $file['name'];

try {
    $table->Update($postData, "id",$_POST['id']);
    //successfully updated
    header("Location:../product.php");
}
catch (Exception){
    $_SESSION['error']="error while update please try again";
    $_SESSION['color']="red";
    header("../product.php?edit={$_POST['id']}");
}



