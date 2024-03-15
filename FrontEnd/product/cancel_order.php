<?php

require "../../BackEnd/DataBase/DBCLass.php"; 
use DbClass\Table; 
$table = new Table("orders");


$order_id = $_GET['order_id']; 

try {
    $table->Delete("id = $order_id");
    header("Location: order.php");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
