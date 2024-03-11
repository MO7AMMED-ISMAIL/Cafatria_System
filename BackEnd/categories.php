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
$selected=$selected->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['add'])){
   $_SESSION['from']=$_GET['add'];
   include "categories/AddCategoryForm.php";
}
elseif(isset($_GET['edit'])){
   include "categories/editCategory.php";
}else{
   include "categories/listCategory.php";
}

include "include/footer.php";
