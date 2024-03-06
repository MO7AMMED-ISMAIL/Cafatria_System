<?php
require("../DataBase/DBCLass.php");
use DbClass\Table;

$table = new Table("products");
$table->conn();

$table->Delete("id={$_GET['id']}");
//successfully deleted

header("Location:../product.php");