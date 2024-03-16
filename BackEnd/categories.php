<?php
session_start();
if(!isset($_SESSION['id'])){
   header("location: Auth/LoginForm.php");
}
$current="categories";
include "./DataBase/DBCLass.php";
include "include/sidebar.php";
include "include/navbar.php";

use DbClass\Table;

$table = new Table("categories");
$selected=$table->Select(["*"]);
$selected=$selected->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['add'])){
   $_SESSION['from']=$_GET['add'];
   include "categories/AddCategoryForm.php";
}
elseif(isset($_GET['edit'])){
    try {
        $table->FindById("id",$_GET['edit']);
        include "categories/editCategory.php";
    }catch (Exception $e){
        include "../FrontEnd/product/empty_message.html";
    }
}else{
   include "categories/listCategory.php";
}

include "include/footer.php";
