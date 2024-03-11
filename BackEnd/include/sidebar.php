<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafateria</title>

    <!-- Bootstrap CSS & js-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html, body {
            height: 100%;
            font-family: 'Ubuntu', sans-serif;
        }

        #sidebar{
            width: 20vw;
            color: white;
        }

        .dropdown-toggle::after {
            content: none; /* Remove the default arrow */
        }
        td img{
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 d-flex h-100">
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-bg-info text-white offcanvas-md offcanvas-start">
            <a href="#" class="navbar-brand text-center">Cafateria</a><hr>
            <ul class="mynav nav nav-pills flex-column flex-grow-1 pe-3 mb-auto">
                <!-- Index -->
                <li class="nav-item mb-1">
                    <a href="index.php" class="nav-link text-white <?= $current == 'index'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user"></i>
                        Index
                    </a>
                </li>
                <!-- Admins -->
                <li class="nav-item mb-1">
                    <a href="admin.php" class="nav-link text-white <?= $current == 'Admin'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user"></i>
                        Admins
                    </a>
                </li>
                <!-- Users -->
                <li class="nav-item mb-1">
                    <a href="users.php" class="nav-link text-white <?= $current == 'User'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user"></i>
                        Users
                    </a>
                </li>

                <!-- Orders -->
                <li class="nav-item mb-1">
                    <a href="order.php" class="nav-link text-white <?= $current == 'orders'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-cart-shopping"></i>
                        Orders
                    </a>
                </li>

                <!-- Product -->
                <li class="nav-item mb-1">
                    <a href="products.php" class="nav-link text-white <?= $current == 'products'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-store"></i>
                        Products
                    </a>
                </li>

                <!-- Category -->
                <li class="nav-item mb-1">
                    <a href="categories.php" class="nav-link text-white <?= $current == 'categories'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-list"></i>
                        categories
                    </a>
                </li>

                <!-- Checks -->
                <li class="nav-item mb-1">
                    <a href="order.php" class="nav-link text-white <?= $current == 'checks'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-credit-card"></i>
                        Checkout Order
                    </a>
                </li>

                <!-- Room -->
                <li class="nav-item mb-1">
                    <a href="room.php" class="nav-link text-white <?= $current == 'Room'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-person-shelter"></i>
                        Cafetria Room
                    </a>
                </li>
            </ul>
        </div>