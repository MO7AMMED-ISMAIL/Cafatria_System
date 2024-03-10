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


//category table
$category_table=new Table("categories");
$category_table->conn();
$cat_selected = $category_table->Select(["category_name", "id"]);


if(isset($_GET['add']) == 'product'){
    echo"<div class='container'>";
    echo "<div class='row'>";
       echo "<div class='container'>";
        include "products/AddProductForm.php";
        echo "</div>";
    echo "</div>";
   echo "</div>";
}
elseif(isset($_GET['edit'])){
    include "products/editForm.php";
}else{
    include "products/listProducts.php";
}

include "include/footer.php";
