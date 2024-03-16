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
            background: #5C258D;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #4389A2, #5C258D);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #4389A2, #5C258D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .dropdown-toggle::after {
            content: none; /* Remove the default arrow */
        }
        td img{
            width: 30px;
            height: 30px;
        }
        .btn-primary{
            background: #6a3093;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #a044ff, #6a3093);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #a044ff, #6a3093); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 d-flex h-100">
        <div id="sidebar" class="fs-5 d-flex flex-column flex-shrink-0 p-3 text-bg-info text-white offcanvas-md offcanvas-start">
            <a href="./index.php" class="navbar-brand text-center">Cafateria</a><hr>
            <ul class="mynav nav nav-pills flex-column flex-grow-1 pe-3 mb-auto">
                <!-- Index -->
                <li class="nav-item mb-1">
                    <a href="index.php" class="nav-link text-white <?= $current == 'index'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user me-lg-2 d-none d-md-inline-block"></i>
                        Index
                    </a>
                </li>
                <!-- Admins -->
                <li class="nav-item mb-1">
                    <a href="admin.php" class="nav-link text-white <?= $current == 'Admin'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user me-lg-2 d-none d-md-inline-block"></i>
                        Admins
                    </a>
                </li>
                <!-- Users -->
                <li class="nav-item mb-1">
                    <a href="users.php" class="nav-link text-white <?= $current == 'User'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-user me-lg-2 d-none d-md-inline-block"></i>
                        Users
                    </a>
                </li>

                <!-- Product -->
                <li class="nav-item mb-1">
                    <a href="products.php" class="nav-link text-white <?= $current == 'products'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-store me-lg-2 d-none d-md-inline-block"></i>
                        Products
                    </a>
                </li>

                <!-- Category -->
                <li class="nav-item mb-1">
                    <a href="categories.php" class="nav-link text-white <?= $current == 'categories'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-list me-lg-2 d-none d-md-inline-block"></i>
                        categories
                    </a>
                </li>

                <!-- Orders -->
                <li class="nav-item mb-1">
                    <a href="order.php" class="nav-link text-white <?= $current == 'orders'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-cart-shopping me-lg-2 d-none d-md-inline-block"></i>
                        Orders
                    </a>
                </li>

                <!-- Checks -->
                <li class="nav-item mb-1">
                    <a href="checks.php" class="nav-link text-white <?= $current == 'checks'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-regular fa-credit-card me-lg-2 d-none d-md-inline-block"></i>
                        Checks
                    </a>
                </li>

                <!-- Room -->
                <li class="nav-item mb-1">
                    <a href="room.php" class="nav-link text-white <?= $current == 'Room'? 'active' : '' ?>" aria-current="page" >
                        <i class="fa-solid fa-person-shelter me-lg-2 d-none d-md-inline-block"></i>
                        Rooms
                    </a>
                </li>
            </ul>
        </div>