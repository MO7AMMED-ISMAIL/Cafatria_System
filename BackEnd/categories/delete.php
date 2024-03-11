<?php
require("../DataBase/DBCLass.php");

use DbClass\Table;

$table = new Table("categories");
$table->conn();

$table->Delete("id= {$_GET['id']}");

header("Location:../categories.php");