<?php
    session_start();
    $current = 'orders';
    $id = 1 ;
    include "include/sidebar.php";
    include "include/navbar.php";
    include "DataBase/DBCLass.php";
    use DbClass\Table;
    $orders = new Table('orders');
    $users = new Table('users');
    $products = new Table('products');

    $col = [
        'id',
        'user_id',
        'total_price',
        'tax',
        'total_price_after_tax',
        'status',
        'notes',
        'room_number',
        'order_date'
    ];

    $result = $orders->Select($col);
    $users_result = $users->Select(['id', 'username']);
    $products_result = $products->Select(['id', 'name', 'price', 'picture']);

    if(isset($_GET['add']) == 'orders'){
        include "orders/addForm.php";
    }
    elseif(isset($_GET['edit'])){
        $orderId = $_GET['edit'];
        $cond = "id = $orderId";
        $SelOrder = $orders->Select($col,$cond);
        $SelOrder = $SelOrder[0];
        include "orders/editForm.php";
    }else{
        include "orders/table.php";
    }

    include "include/footer.php";
?>