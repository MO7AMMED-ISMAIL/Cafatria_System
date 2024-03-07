    <?php
    include "../DataBase/DBCLass.php";
    use DbClass\Table;
    session_start();

    $orders = new Table('orders');
    $carts = new Table('carts');
    $cart_items = new Table('cart_items ');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        /*if(!isset($_POST['token']) || !isset($_SESSION['token'])){
            exit('Token is not set');
            include "../404.html";
        }

        if($_POST['token'] == $_SESSION['token']){
            if(time() >= $_SESSION['token_expire']){
                exit('Token is Expired');
                include "../404.html";
            }
            unset($_SESSION['token']);
        }*/
        echo "<pre>";
        var_dump($_POST);echo "</pre>";
        try{
            $user_id = $carts->inputData($_POST['user_id']);
            $total_price = $orders->inputData($_POST['order_total_price']);

            $cartData = [
                'user_id' => $user_id,
                'total_price' => $total_price
            ];

            $cartCreated = $carts->Create($cartData);
            $cartId = $carts->connect()->lastInsertId();
//            $cart_id = $cartCreated['cart_id'];
//            $product_id = $cart_items->inputData($_POST['product_id']);
//            $quantity = $cart_items->inputData($_POST['quantity']);
//            $price = $cart_items->inputData($_POST['pro']);
//            $total_price = $cart_items->inputData($_POST['total_price']);
//            $email = $orders->ValidateEmail($_POST['email']);
//
//            $room_number = $orders->inputData($_POST['room_number']);
//            $notes = $orders->inputData($_POST['notes']);

            $cartItemsData = [
                'cart_id' => $cartId,
                'product_id'=> [$_POST['product_id']],
                'price'=> [$_POST['product_id']],
                'quantity'=> [$_POST['quantity']],
                'total_price' => [$_POST['product_total_price']],
            ];

//            $orderData = [
//
//                'name'=>$name,
//                'email'=>$email,
//                'room_number'=>$room,
//                'extra_Number'=>$ext
//            ];
//            $orders->Create($orderData);
//            header("location: ../order.php");
            exit();
        }catch(Exception $e){
            $_SESSION['err'] = $e->getMessage();
            header("location: ../order.php?add=Orders");
            exit();
        }
    }
?>