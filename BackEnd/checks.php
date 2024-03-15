<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: Auth/LoginForm.php");
}

$current = 'checks';
$id = 1 ;
include "DataBase/DBCLass.php";
use DbClass\Table;
$orders = new Table('orders');
$order_items = new Table('order_items');
$users = new Table('users');
$products = new Table('products');
include "include/sidebar.php";
include "include/navbar.php";

// Search in order
if(isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['user_id']) && !empty($_GET['start_date']) && !empty($_GET['end_date']) && !empty($_GET['user_id'])){
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $user_id = $_GET['user_id'];
    $condition = "orders.user_id = '$user_id' AND orders.order_date BETWEEN '$start_date' AND '$end_date'";
    $users_orders_result =$orders->UserNamesWithOrderPrices($condition);
}else {
    $users_orders_result =$orders->UserNamesWithOrderPrices();
}

$users_result = $users->Select(['id', 'username']);


include "checks/table.php";

include "include/footer.php";
?>