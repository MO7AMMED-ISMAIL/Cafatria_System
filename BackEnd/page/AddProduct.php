<?php
require ("../DataBase/DBCLass.php");
use DbClass\Table;

$table= new Table("products");
$table->conn();
$file=$_FILES["product_image"];

$postData = [];
if($_POST['category_id']=="default"){
    header("Location:product.php");
    setcookie("error","missing category");
    setcookie("color","red");
}

foreach ($_POST as $key => $value) {
    $postData[$key] = $value;
}

move_uploaded_file($file['tmp_name'], './product_images/' . $file['name']);
$postData['picture']=$file['name'];

$table->Create($postData);

//successfully inserted
header("Location:product.php");
setcookie("success","successfully inserted");
setcookie("color","green");










//
//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
//
//echo "<pre>";
//var_dump($_FILES);
//echo "</pre>";


