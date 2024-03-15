<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: Auth/LoginForm.php");
    }
    include "./DataBase/DBCLass.php";
    use DbClass\Table;
    $current = "index";
    $admins = new Table('admins');
    $users = new Table('users');
    $products = new Table('products');
    $categories = new Table('categories');
    $rooms = new Table('rooms');
    $orders = new Table('orders');
    $order_items = new Table('order_items');

    include "include/sidebar.php";
    include "include/navbar.php";
?>

<div class="container-fluid">
    <div class="row mb-4"> <!-- row col card card-body -row col col -->
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body h-100 p-5">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <div class="text-start">
                                <h1 class="text-primary">Welcome back, Your admin dashboard is ready now.</h1>
                                <p class="text-gray-700 mb-0">Browse all pages of cafeteria orders, admins, users, products, categories, rooms and another features</p>
                            </div>
                        </div>
                        <div class="col d-none d-lg-block text-center"><img class="img-fluid px-xl-4" src="uploads/statistics.svg" style="max-width: 26rem"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row fs-5 mb-5">
        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-primary text-white h-100 shadow border-left-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Users</div>
                            <div class="text-lg fw-bold"><?= $users->rowCount('users')?></div>
                        </div>
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="users.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Admims -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Admins</div>
                            <div class="text-lg fw-bold"><?= $admins->rowCount('admins')?></div>
                        </div>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="admin.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Products</div>
                            <div class="text-lg fw-bold"><?= $products->rowCount('products')?></div>
                        </div>
                        <i class="fa-solid fa-store"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="products.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Categories</div>
                            <div class="text-lg fw-bold"><?= $categories->rowCount('categories')?></div>
                        </div>
                        <i class="fa-solid fa-table-list"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="categories.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- rooms-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Rooms</div>
                            <div class="text-lg fw-bold"><?= $rooms->rowCount('rooms')?></div>
                        </div>
                        <i class="fa-solid fa-house"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="room.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Orders</div>
                            <div class="text-lg fw-bold"><?= $orders->rowCount('orders')?></div>
                        </div>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="order.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checks -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Checks</div>
                            <div class="text-lg fw-bold"><?= $order_items->rowCount('order_items')?></div>
                        </div>
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="checks.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checks -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-primary text-white h-100 shadow border-left-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Earnings</div>
                            <div class="text-lg fw-bold"><?= $order_items->earningMoney('orders')?></div>
                        </div>
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link text-decoration-none" href="order.php">View Details</a>
                    <div class="text-white">
                        <i class="fa-solid fa-right-long"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php 
    include "include/footer.php";
?>




