<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/styles.css" />
    <style>
      .details-hidden {
            display: none;
        }
        .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #333;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
 }


.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}


.total-price {
    margin-top: 20px;
}

.total-price h3 {
    margin-bottom: 0;
    font-size: 2.25rem;
    color: black; 
}

.total-price {
    font-size: 2.25rem;
    color: red; 
}
    </style>
</head>

<body>
    <main class="my-orders">
        <section class="main-padding">
            <div class="container py-5">
                <h1>My Orders</h1>
              
                <form action="">
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
                        <tbody>
                        <?php
                         
                            $servername = "localhost";
                            $username = "root";
                            $password = "1234";
                            $dbname = "cafeteria";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                           
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            
                            $sql = "SELECT orders.id, orders.order_date, orders.status, orders.total_price
                                    FROM orders";
                            $result = $conn->query($sql);

                            $totalAmount = 0; 

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr class="order">';
                                    echo '<td><span>' . $row["order_date"] . '</span><i class="fa fa-plus-square mx-5"></i></td>';
                                    echo '<td>' . $row["status"] . '</td>';
                                    echo '<td><span>' . $row["total_price"] . '</span> EGP</td>';

                                
                                    if ($row["status"] == "Processing") {
                                        echo "<td><a href='delete_order.php?id={$row['id']}' class='cancel btn btn-danger'>Cancel</a></td>";
                                    } else {
                                        echo '<td></td>'; 
                                    }

                                    echo '</tr>';

                                 
                                    $order_id = $row["id"];
                                    $cart_items_sql = "SELECT products.name,products.picture, cart_items.price, cart_items.quantity, cart_items.total_price
                                                    FROM cart_items
                                                    INNER JOIN products ON cart_items.product_id = products.id
                                                    WHERE cart_items.cart_id = (SELECT cart_id FROM orders WHERE id = $order_id)";

                                    $cart_items_result = $conn->query($cart_items_sql);

                                    if ($cart_items_result->num_rows > 0) {
                                        while ($cart_item_row = $cart_items_result->fetch_assoc()) {
                                            echo '<tr class="cart-item details-hidden">';
                                            echo '<td colspan="4">';
                                            echo '<div class="cart-item-details">';
                                            echo '<div class="cart-item-info">';
                                            echo '<span style="margin-right: 10px;">Name: ' . $cart_item_row["name"] . '</span>';
                                            echo '<span style="margin-right: 10px;">Quantity: ' . $cart_item_row["quantity"] . '</span>';
                                            echo '<span style="margin-right: 10px;">Price: ' . $cart_item_row["price"] . ' EGP</span>';
                                            echo '<span style="margin-right: 10px;">Total: ' . $cart_item_row["total_price"] . ' EGP</span>';
                                            
                                            echo '</div>';
                                            echo '<div class="cart-item-picture">';
                                            echo '<img src="' . $cart_item_row["picture"] . '" alt="' . $cart_item_row["name"] . '" />';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    

                                    $totalAmount += floatval($row["total_price"]);
                                }
                            } else {
                                echo "<tr><td colspan='4'>No orders found</td></tr>";
                            }

                            
                            $conn->close();
                            ?>
                        </tbody>
                    </table>

                    <div class="total-price">
                        <h3>Total</h3>
                        <h3>EGP <span><?php echo $totalAmount; ?></span></h3>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="../js/04_user-orders.js"></script>
</body>

</html>