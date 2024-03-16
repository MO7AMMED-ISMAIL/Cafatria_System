<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: Auth/LoginForm.php");
}
$current="products";
include "./DataBase/DBCLass.php";
include "include/sidebar.php";
include "include/navbar.php";

use DbClass\Table;

//define tables to avoid scope error
$table=new Table("products");
$selected=[];
$category_table=new Table("categories");
$cat_selected=[];


try {
    $selected = $table->SelectInnerJoinTable("categories", ["category_name"], ["*"], "categories.id=products.category_id");
}catch (Exception $e){
    //empty table
    $selected=[];
}


//category table
try {
    $cat_selected = $category_table->Select(["category_name", "id"]);
    $cat_selected=$cat_selected->fetchAll(PDO::FETCH_ASSOC);
}catch (Exception $e){
    //empty table
    $cat_selected=[];
}



//handle many pages
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
    try {
        $table->FindById("id",$_GET['edit']);
        include "products/editForm.php";
    }catch (Exception $e){
        include "../FrontEnd/product/empty_message.html";
    }

}else{
    include "products/listProducts.php";
}

include "include/footer.php";
