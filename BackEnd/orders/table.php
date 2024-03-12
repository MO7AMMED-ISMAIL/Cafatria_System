<div class="container-fluid">
    <!-- DataTales Example -->
    <?php
    if(isset($_SESSION['success'])){
        echo "<div class='row mx-1 px-4 alert alert-success' role='alert' id='success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">Table Orders</h4>
                <a href="?add=Admin" class="col-2 me-2 btn btn-primary">Add Order</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-responsive">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Total Price</th>
                    <th>room Number</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($result)) {
                    foreach($result as $order){
                        ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td><?=$order['user_id']?></td>
                            <td><?=$order['total_price']?> $</td>
                            <td><?=$order['room_id']?></td>
                            <td>
                                <?php if($order['status'] == 'Done') {?>
                                    <span class="badge text-bg-success"><?=$order['status']?></span>
                                <?php } elseif ($order['status'] == 'Processing'){ ?>
                                    <span class="badge text-bg-warning"><?=$order['status']?></span>

                                <?php } else { ?>
                                    <span class="badge text-bg-danger"><?=$order['status']?></span>
                                <?php } ?>
                            </td>
                            <td><?=$order['order_date']?></td>
                            <td>
                                <?php if ($order['status'] == 'Processing') {?>
                                    <a class="btn btn-outline-danger" href="orders/delete.php?order_id=<?=$order['id']?>">Cancel</a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr class="text-center">
                        <td colspan="9">
                            <img src="./uploads/no-data.gif" alt="" style="width: 80%; height: 50vh;">
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>

</html>