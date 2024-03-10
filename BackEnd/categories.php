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

if(isset($_GET['add']) == 'category'){
   echo "add";
}
elseif(isset($_GET['edit'])){
   echo "edit";
}else{
   echo "list";
}

include "include/footer.php";
