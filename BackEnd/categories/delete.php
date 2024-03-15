<?php
session_start();
require("../DataBase/DBCLass.php");

use DbClass\Table;

$table = new Table("categories");


if(isset($_GET['id'])) {
    try {

        $table->Delete("id={$_GET['id']}");
//successfully deleted
        $_SESSION["message"] = "successfully deleted";
        $_SESSION["color"] = "green";

        $table->Delete("id= {$_GET['id']}");

        header("Location:../categories.php");
    }catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../404.php");
}