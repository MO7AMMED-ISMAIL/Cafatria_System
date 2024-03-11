<?php

require("../DataBase/DBCLass.php");

use DbClass\Table;

$table = new Table("categories");
$table->conn();

$currentDate = date("Y-m-d H:i:s");
echo $currentDate;

$posted['category_name']=$_POST['category_name'];
$posted['category_description']=$_POST['category_description'];
$posted['created_at']=$currentDate;

$table->Update($posted,'id',$_POST['id']);


//successfully updated

header("Location:listCategories.php");