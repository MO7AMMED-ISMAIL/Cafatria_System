<?php
session_start();
$current = 'product';
$id = 1 ;
include "include/sidebar.php";
include "include/navbar.php";
include("DataBase/DBCLass.php");
use DbClass\Table;


$table = new Table("products");
$table->conn();

$selected=$table->Select(["*"]);

if(isset($_GET['add']) == 'product'){
    include "page/AddProductForm.php";
}
elseif(isset($_GET['edit'])){

    include "page/editForm.php";
}else{
    include "page/listProducts.php";
}

include "include/footer.php";
?>