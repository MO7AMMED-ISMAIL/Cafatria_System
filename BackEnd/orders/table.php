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
                    <th>Order Date</th>
                    <th>Username</th>
                    <th>Room</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($orders_result)) {
                    foreach($orders_result as $order){
                        ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td><?=$order['order_date']?></td>
                            <td><?=$users->FindById('id',$order['user_id'])['username']?></td>
                            <td><?=$order['room_number']?></td>
                            <td><?=$order['total_price']?> <span class="badge-success">$</span></td>
                            <td>
                                <?php if($order['status'] == 'Done') {?>
                                    <span class="badge text-bg-success"><?=$order['status']?></span>
                                <?php } elseif ($order['status'] == 'Processing'){ ?>
                                    <span class="badge text-bg-warning"><?=$order['status']?></span>

                                <?php } else { ?>
                                    <span class="badge text-bg-danger"><?=$order['status']?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-outline-success" href="?show=<?=$order['id']?>">Show</a>
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
<!--<select class="form-select btn btn-outline-info w-100" aria-label="status">-->
<!--    --><?php //$orderStatus = ['Processing', 'Out For Delivery', 'Done', 'Cancelled'];
//    foreach($orderStatus as $status){ ?>
<!--        <option value="--><?php //=$status?><!--" --><?php //= $order['status'] == $status ? 'selected' : ''?><!--><?php //=$status?><!--</option>-->
<!--    --><?php //}?>
<!--</select>-->