<?php
if(!isset($_SESSION['id'])){
    header("location: ../404.php");
    exit; // It's good practice to exit after redirecting
}
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="row mx-1 px-4 alert alert-success" role="alert" id="success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="start_date" placeholder="Date From" aria-label="Date From">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="end_date" placeholder="Date To" aria-label="Date To">
                </div>
                <div class="col">
                    <select name="user_id" id="user_id" class="form-control form-select">
                        <option value="">Select User</option>
                        <?php foreach($users_result as $user) {?>
                            <option value="<?=$user['id']?>"><?=$user['username']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-outline-success">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">Checks</h4>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <tbody>
                <?php if (!empty($users_orders_result)): ?>
                    <?php foreach($users_orders_result as $user): ?>
                        <tr>
                            <td colspan="2">
                                <div class="accordion accordion-flush" id="accordionExample">
                                    <div class="accordion-item m-4">
                                        <h2 class="accordion-header" id="heading<?= $user['user_id'] ?>">
                                            <button class="accordion-button collapsed border rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $user['user_id'] ?>" aria-expanded="true" aria-controls="flush-collapse<?= $user['user_id'] ?>">
                                                <span class="col"><span class="text-secondary">Username: </span><?= $user['username'] ?></span>
                                                <span class="col"><span class="text-secondary">Total Price: </span><?= $user['order_total_price'] ?> <span class="badge text-bg-success">$</span></span>
                                            </button>
                                        </h2>

                                        <div id="flush-collapse<?= $user['user_id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $user['user_id'] ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <table class="table table-bordered table-hover table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Order Date</th>
                                                        <th>Total Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $userId = $user['user_id'];
                                                    $userOrders = $orders->Select(['id','order_date', 'total_price'], "user_id='$userId'");
                                                    foreach ($userOrders as $order): ?>
                                                        <tr>
                                                            <td><?= $order['id'] ?></td>
                                                            <td><?= $order['order_date'] ?></td>
                                                            <td><?= $order['total_price'] ?> <span class="badge text-bg-success">$</span></td>
                                                            <td>
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $order['id'] ?>">
                                                                    Show Details
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="staticBackdrop<?= $order['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 g-4 justify-content-start align-items-center mb-3">
                                                                                    <?php
                                                                                    $orderId = (int) $order['id'];
                                                                                    $orderItems = $orders->SelectInnerJoinTable("order_items", ["*"], ["*"], "orders.id=order_items.order_id", "orders.id=$orderId");

                                                                                    foreach($orderItems as $orderItem): ?>
                                                                                        <?php $product = $products->FindById('id', $orderItem['product_id']);
                                                                                        if ($product): ?>
                                                                                            <div class="col product_card">
                                                                                                <div class="card shadow position-relative" style="height:200px">
                                                                                                    <img class="card-img-top" style="height: 15vh" src="uploads/<?= $product['picture'] ?>" alt="...">
                                                                                                    <div class="card-body text-center">
                                                                                                        <h5 class="card-title text-center"><?= $product['name'] ?></h5>
                                                                                                        <p class="badge text-bg-secondary"><?= $orderItem['quantity'] ?></p>
                                                                                                    </div>
                                                                                                    <!-- Badge for each product card -->
                                                                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                                                                        <?= $orderItem['product_price'] ?> $
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="text-center">
                        <td colspan="2">
                            <img src="./uploads/no-data.gif" alt="" style="width: 80%; height: 50vh;">
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
