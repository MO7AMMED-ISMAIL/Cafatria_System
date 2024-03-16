<?php
require("../DataBase/DBCLass.php");
use DbClass\Table;
session_start();
$table = new Table("products");


if(isset($_GET['id'])) {

    try {
        $table->FindById("id",$_GET['id']);
    }catch (Exception $e){
        header("Location:../../FrontEnd/product/empty_message.html");
        die();
    }


    try {
        $table->Delete("id={$_GET['id']}");
//successfully deleted
        $_SESSION["message"]="Product deleted successfully";
        $_SESSION["color"]="green";
        header("Location:../products.php");
    }catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../404.php");
}