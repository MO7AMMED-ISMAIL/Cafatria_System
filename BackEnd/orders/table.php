<div class="container-fluid">
    <!-- DataTales Example -->
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
                    <th>Room Number</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($result as $order){
                    ?>
                    <tr>
                        <td><?=$id++?></td>
                        <td><?=$order['user_id']?></td>
                        <td><?=$order['total_price']?></td>
                        <td><?=$order['room_number']?></td>
                        <td><?=$order['status']?></td>
                        <td><?=$order['order_date']?></td>
                        <td>
                            <?php if ($order['status'] == 'Processing') {?>
                                <a class="btn btn-danger" href="orders/delete.php?order_id=<?=$order['id']?>">Cancel</a>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>

</html>