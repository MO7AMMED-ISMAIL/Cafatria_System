<?php
include "../DataBase/DBCLass.php";
use DbClass\Table;
session_start();
$orders = new Table('orders');

if(isset($_GET['order_id'])){
    try{
        $orderId = $_GET['order_id'];
        $order = $orders->FindById('id',$orderId);
        //update
        if ($order['status'] == "Processing") {
            $DataUpdate = [
                'status'=> 'Out For Delivery',
            ];
        } elseif( $order['status'] == "Out For Delivery") {
            $DataUpdate = [
                'status'=> 'Done',
            ];
        }

        $updatedOrder = $orders->Update($DataUpdate,'id',$orderId);
        $_SESSION['success'] = 'Order Updated Successfully';

        header("location: ../order.php");
        exit();
    }catch(Exception $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../order.php?edit=$id");
        exit();
    }
    
}else{
    header("location: ../404.php");
}



?>