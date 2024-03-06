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

$selected=$table->SelectInnerJoinTable("categories",["cat_name"],["*"],"categories.id=products.category_id");

if(isset($_GET['add']) == 'product'){
    include "Product/AddProductForm.php";
}
elseif(isset($_GET['edit'])){
    include "Product/editForm.php";
}else{
    include "Product/listProducts.php";
}

include "include/footer.php";
?>