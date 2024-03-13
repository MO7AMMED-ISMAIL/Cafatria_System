<?php
require "../../BackEnd/DataBase/DBCLass.php";
use DbClass\Table;

//connect to order table
$orderTable=new Table("orders");
$orderTable->conn();


//connect to order items table
$orderItemTable=new Table("order_items");
$orderItemTable->conn();


//prepare order details
$orderDetails=[];


if(!$_POST['notes'])
    $orderDetails['notes']=NULL;
else
{
    $orderDetails['notes']=$_POST['notes'];
}
$orderDetails['total_price']=$_POST['totalPrice'];
$orderDetails['user_id']=$_POST['user_id'];
$orderDetails['tax']=0.1;
$orderDetails['status']="Processing";
$orderDetails['total_price_after_tax']=floatval($orderDetails['total_price']*1.1);
$orderDetails['room_number']="Cafeteria";

print_r($orderDetails);

//insert order details
$orderTable->Create($orderDetails);


//count orders after insertion
$orders=$orderTable->Select(["id"])->rowCount();

//prepare order items
$orderItems=[];

$parsedItems=json_decode($_POST["selectedProductsList"]);

foreach ($parsedItems as $item){
    $itemArray = (array) $item;

    $itemArray['order_id'] = $orders;

    // insert order item
    $orderItemTable->Create($itemArray);
}






// form submission
orderForm.addEventListener('submit', function(event) {
    event.preventDefault();
    updateOrderForm();

    // Serialize selectedProductsList into a JSON string
    const selectedProductsJSON = JSON.stringify(selectedProductsList);

    // Create a new FormData object
    const formData = new FormData(orderForm);

    // Append selectedProductsList to the FormData object
    formData.append('selectedProductsList', selectedProductsJSON);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'addOrder.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.body.innerHTML = xhr.responseText;
        } else {
            console.error('Error:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request failed');
    };
    xhr.send(formData);
});