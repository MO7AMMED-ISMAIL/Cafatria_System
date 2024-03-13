<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: Auth/LoginForm.php");
    }
    $current = 'orders';
    $id = 1 ;
    include "DataBase/DBCLass.php";
    use DbClass\Table;
    $orders = new Table('orders');
    $rooms = new Table('rooms');
    $users = new Table('users');
    $products = new Table('products');
    include "include/sidebar.php";
    include "include/navbar.php";

    $col = [
        'id',
        'user_id',
        'total_price',
        'tax',
        'total_price_after_tax',
        'status',
        'notes',
        'order_date'
    ];

    $result=$orders->SelectInnerJoinTable("rooms",["room_number"],["*"],"rooms.id=orders.room_id");
    $users_result = $users->Select(['id', 'username']);
    $products_result = $products->Select(['id', 'name', 'price', 'picture']);
    $rooms_result = $rooms->Select(['id', 'room_number']);


    if(isset($_GET['add']) == 'orders'){
        include "orders/addForm.php";
    }
    elseif(isset($_GET['edit'])){
        $orderId = $_GET['edit'];
        $SelOrder = $orders->FindById('id',$orderId);
        include "orders/editForm.php";
    }else{
        include "orders/table.php";
    }

    include "include/footer.php";
?>