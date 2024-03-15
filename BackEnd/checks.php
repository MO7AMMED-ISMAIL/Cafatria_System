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

$users_orders_result =$orders->UserNamesWithOrderPrices();
$users_result = $users->Select(['id', 'username']);


include "checks/table.php";

include "include/footer.php";
?>