<?php
session_start();
$current="products";
include "./DataBase/DBCLass.php";
include "include/sidebar.php";
include "include/navbar.php";

use DbClass\Table;

$table = new Table("products");
$table->conn();

$selected=$table->SelectInnerJoinTable("categories",["category_name"],["*"],"categories.id=products.category_id");

if(isset($_GET['add']) == 'product'){
    include "products/AddProductForm.php";
}
elseif(isset($_GET['edit'])){
    include "products/editForm.php";
}else{
    include "products/listProducts.php";
}

include "include/footer.php";
