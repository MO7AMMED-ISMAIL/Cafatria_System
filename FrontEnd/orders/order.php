<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="My_Order.css">
</head>

<?php
    include "../../BackEnd/DataBase/DBCLass.php";
    use DbClass\Table;
    $userId = isset($_GET['userId']) ? $_GET['userId'] : 4;
    $totalAmount = 0;
    if(isset($_GET['start']) && isset($_GET['end']) && !empty($_GET['start']) && !empty($_GET['end'])){
        $start = $_GET['start'];
        $end = $_GET['end'];
        $orders = new Table('orders');
        $cond = "o.order_date BETWEEN '$start' AND '$end'";
        $userOrder = $orders->UserOrders($userId,$cond);
    } else {
        $orders = new Table('orders');
        $userOrder = $orders->UserOrders($userId);
    }
    
?>

<body>
    <main class="my-orders">
        <section class="main-padding">
            <div class="container py-5">
                <h1>My Orders</h1>
                <form action="" method="GET" id="searchForm">
                    <input type="hidden" name="userId" value="<?=$userId?>" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="from-group">
                                <label for="start">Date from:</label>
                                <input type="date" class="form-control start" name="start" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="end">Date to:</label>
                                <input type="date" class="form-control end" name="end" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mx-2">Search</button>
                            <a href="order.php" class="btn btn-danger mt-2">Clear</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </section>

        <section class="main-padding">
            <div class="container">
                <div class="user-orders">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php
                                foreach($userOrder as $order){
                            ?>
                            <tr class="order">
                                <td>
                                    <span><?=$order['order_date']?></span>
                                    <i class="fa fa-plus-square mx-5"></i>
                                </td>

                                <td class="Processing">
                                    <?php 
                                        if ($order['status'] == 'Processing') { ?>
                                        <i class="btn btn-warning"></i>
                                        <?=$order['status']?>
                                        <?php } else { ?>
                                        <?=$order['status']?>
                                        <?php } ?>
                                </td>

                                <td>
                                    <span>
                                        <?php
                                        $totalAmount += $order['price'] * $order['quantity']; 
                                        echo $order['price'] * $order['quantity'];
                                        ?>
                                    </span> EGP
                                </td>
                                <td>
                                    <?php 
                                        if ($order["status"]=='Processing') { 
                                    ?>
                                        <a href='cancel_order.php?order_id=<?= $order['id'] ?>' class='cancel btn btn-danger'>Cancel</a>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr class="cart-item details-hidden">
                                <td>
                                    <div class="cart-item-details">
                                        <div class="cart-item-info d-flex justify-content-center">
                                            <div class="card shadow position-relative align-items-center mb-3"
                                                style="width: 15rem;">
                                                <img class="card-img-top" src="<?=$order['picture']?>" alt="Product Name">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">
                                                        <?=$order['name']?>
                                                    </h5>
                                                    <p class="card-text">
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                            <?=$order['price']?>EGP</span><br>
                                                        Quantity: <?=$order['quantity']?><br>
                                                        Total: <?=$order['price'] * $order['quantity']?> EGP
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="total-price">
                        <h3>Total</h3>
                        <h4>EGP <span id="totalAmount"><?= $totalAmount ?></span></h4>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="My_Order.js"></script>

</body>

<!--
        public function UserOrdersByDate($userId, $start, $end) {
        $sql = "SELECT DISTINCT o.id, o.status, o.order_date, o.tax, ot.quantity, p.name, p.picture, p.price  
                FROM $this->TbName AS o 
                JOIN order_items AS ot ON o.id = ot.order_id
                JOIN products AS p ON ot.product_id = p.id
                WHERE o.user_id = '$userId' AND o.order_date BETWEEN '$start' AND '$end'";

        $stmt = parent::connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }

  
}
-->

</html>
