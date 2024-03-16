    <?php
    include "../DataBase/DBCLass.php";
    use DbClass\Table;
    session_start();

    $orders = new Table('orders');
    $order_items = new Table('order_items');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!isset($_POST['token']) || !isset($_SESSION['token'])){
            exit('Token is not set');
            include "../404.html";
        }

        if($_POST['token'] == $_SESSION['token']){
            if(time() >= $_SESSION['token_expire']){
                exit('Token is Expired');
                include "../404.html";
            }
            unset($_SESSION['token']);
        }

        try{
            $user_id = $orders->inputData($_POST['user_id']);
            $total_price = $orders->inputData($_POST['order_total_price']);
            $notes = $orders->inputData($_POST['notes']);
            $room_id = $orders->inputData($_POST['room_id']);

            $orderData = [
                'user_id' => $user_id,
                'total_price' => $total_price,
                'notes' => $notes,
                'room_id' => $room_id
            ];

            $createdOrderId = $orders->Create($orderData);

            $orderItemsJSON = $_POST["orderItems"];
            $orderItems = json_decode($orderItemsJSON, true);

            foreach ($orderItems as $order) {
                $orderItemData = [
                    'order_id'      => $createdOrderId,
                    'product_id'    => $order['product_id'],
                    'product_price' => $order['product_price'],
                    'quantity'      => $order['quantity'],
                    'total_price'   => $order['quantity'] * $order['product_price'],
                ];

                $order_items->Create($orderItemData);
            }
            $_SESSION['success'] = 'Order Added Successfully';

            header("location: ../order.php");
            exit();
        }catch(Exception $e){
            $_SESSION['err'] = $e->getMessage();
            header("location: ../order.php?add=Orders");
            exit();
        }
    }else{
        header("Location: ../404.php");
    }
?>