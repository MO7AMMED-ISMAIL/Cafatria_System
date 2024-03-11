<?php
session_start();
$current="categories";
include "./DataBase/DBCLass.php";
include "include/sidebar.php";
include "include/navbar.php";

use DbClass\Table;

$table = new Table("categories");
$table->conn();
$selected=$table->Select(["*"]);

if(isset($_GET['add'])){
   include "categories/AddCategoryForm.php";
}
elseif(isset($_GET['edit'])){
   echo "edit";
}else{
   include "categories/listCategory.php";
}

include "include/footer.php";
