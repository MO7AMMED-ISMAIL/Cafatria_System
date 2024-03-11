<?php
session_start();
$from=$_SESSION['from'];
unset($_SESSION['from']);
require("../DataBase/DBCLass.php");

use DbClass\Table;

// Create a connection to the products table
$table = new Table("categories");
$table->conn();

$table->Create($_POST);

if ($from=="product"){
    header("Location:../products.php?add=product");
}

//successfully created
header("Location:../categories.php?add=category");