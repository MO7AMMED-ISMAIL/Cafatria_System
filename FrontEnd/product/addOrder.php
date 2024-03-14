<?php
require "../../BackEnd/DataBase/DBCLass.php";
use DbClass\Table;

$orderTable = new Table("orders");
$orderItemTable = new Table("order_items");


$orderDetails = [];

if (!isset($_POST['notes'])) {
    $orderDetails['notes'] = NULL;
} else {
    $orderDetails['notes'] = $_POST['notes'];
}
$orderDetails['total_price'] = $_POST['totalPrice'];
$orderDetails['user_id'] = $_POST['user_id'];
$orderDetails['tax'] = 0.1;
$orderDetails['status'] = "Processing";
$orderDetails['total_price_after_tax'] = floatval($orderDetails['total_price'] * 1.1);
$orderDetails['room_id'] = $_POST['room'];


try {
    $lastID = $orderTable->Create($orderDetails);
    
} catch (Exception $e) {
    echo "Error inserting order details: " . $e->getMessage();
    exit();
}


$orders=$orderTable->Select(["id"])->rowCount();

$parsedItems=json_decode($_POST["selectedProductsList"]);
foreach ($parsedItems as $item) {

    $itemArray = (array) $item;

    $totalPrice = $itemArray['price'] * $itemArray['quantity'];

    $insertData = array(
        'order_id' => $lastID,
        'product_id' => $itemArray['product_id'],
        'product_price' => $itemArray['price'],
        'quantity' => $itemArray['quantity'],
        'total_price' => $totalPrice
    );

    
    $orderItemTable->Create($insertData);
}

header('Location: order.php');
exit();

?>

