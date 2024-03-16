<?php
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
} else {
    header('Location: login.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    header('Location: login.php');
    exit();
}

require "../../BackEnd/DataBase/DBCLass.php";

use DbClass\Table;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


 <!--cafe name-->
 <div id="Home" class="mainhome jumbotron jumbotron-fluid bg-cover d-flex align-items-center">
        <!-- Navigation bar -->
        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark" style="background-color:transparent;">
            <div class="container-fluid">
                <div class="row  align-items-center">
                    <!-- User image and name -->
                    <div class="col-auto">
                        <div class="d-flex align-items-center">

                            <!-- user image -->
                            <?php
                            $userTable = new Table('users');
                            $userDataQuery = $userTable->Select(['profile_picture', 'username'], 'id = ' . $user_id);
                            $userData = $userDataQuery->fetch(PDO::FETCH_ASSOC);

                            if ($userData && isset($userData['profile_picture'])) {
                                echo '<img id="userimg" src="../../BackEnd/uploads/' . $userData['profile_picture'] . '" alt="User Image" class="img-fluid rounded-circle mr-2">';
                            }
                            ?>
                            <!-- username -->
                            <?php
                            if ($userData && isset($userData['username'])) {
                                echo '<p class="text-white mb-0">' . $userData['username'] . '</p>';
                            }
                            ?>
                        </div>
                    </div>


                    <!-- Search input and button -->
                    <div class="col-auto ms-auto">
                        <div class="input-group d-none d-lg-flex">
                            <form class="input-group d-none d-lg-flex" action="productinfo.php" method="GET">
                                <input type="text" id="productNameInput" name="search" class="form-control" placeholder="Search for products...">
                                <div class="input-group-append">
                                    <button id="searchButton" class="lince btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- Nav icon  -->
                    <div class="col-auto">
                        <button id="navToggle" class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav" style="margin-top:3%;">
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="index.php#Home" style="width:100%;">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="menu.php" style="width:100%;">Menu</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="index.php#Latestorder" style="width:100%;">Latest Order</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="index.php#productSection" style="width:100%;">Order now</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="order.php" style="width:100%;">My 0rders</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="index.php?logout=1" style="width:100%;">Log out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Nav drawer -->
        <div id="sideNav" class="nav-drawer d-lg-none">
            <ul class="mt-4">
                <li>
                    <!-- Search input and button -->
                    <form class="input-group" action="productinfo.php" method="GET">
                        <input type="text" id="productNameInput" name="search" class="form-control" placeholder="Search for products...">
                        <div class="input-group-append">
                            <button id="searchButton" class="lince btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </li>


                <li><a href="#Home">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="index.php#Latestorder">Latest Order</a></li>
                <li><a href="index.php#productSection">Order now</a></li>
                <li><a href="order.php">My 0rders</a></li>
                <li><a onclick="logout();" href="login.php">Log out</a></li>
            </ul>

            <button id="navClose" class="btn btn-outline-light mb-2 ml-2">Close</button>
        </div>

        <div class="container">
            <h1 class="display-4 my-5" style="font-style: italic; font-size: 10.6em; color: rgba(237, 243, 246, 0.753);">Cafeto</h1>
            <div id="slogann">
                <p id="sloganTextt" class="lead col-12">Unveiling Richness with Every Scroll, Because the Best Brews Are Worth the Search</p>
            </div>
        </div>
    </div>


    
    <?php
  $table = new Table('products');


    if (isset($_GET['search'])) {
        $search = $_GET['search'];


        $selected = $table->Select(['*'], "status = 'Available' AND name LIKE '$search'");
        $selectedProduct = $selected->fetch(PDO::FETCH_ASSOC);
        if (!empty($selectedProduct)) {
    ?>
            <div class="row my-5 text-center">
                <div class="card mx-auto col-md-5 col-12 maincard">
                    <img src="../../BackEnd/uploads/<?php echo $selectedProduct['picture']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selectedProduct['name']; ?></h5>
                        <p class="card-text" style="color: #d06663; font-size: large;">Price:$ <?php echo $selectedProduct['price']; ?></p>
                    </div>
                </div>
            </div>

            <?php

            // Related products
            $categoryId = $selectedProduct['category_id'];
            $relatedProductsquery = $table->Select(['*'], "category_id = $categoryId AND id != {$selectedProduct['id']} LIMIT 4");
            $relatedProducts = $relatedProductsquery->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($relatedProducts)) {
            ?>
                <div class="related-products container my-5">
                    <div class="row">
                        <h2 class="text-center text-light mt-5 my-5" style="padding: 1.5%; background-color: rgba(71, 44, 8, 0.816);">Related Products</h2>
                    </div>

                    <div class="row text-center">
                        <?php
                        foreach ($relatedProducts as $row) {
                        ?>
                            <div class="col-md-3 col-10 offset-2 offset-md-0  text-center my-5">
                                <div class="card cardss">
                                    <img src="../../BackEnd/uploads/<?php echo $row['picture']; ?>" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                        <p class="card-text"style="color: #d06663; font-size: large;">Price:$ <?php echo $row['price']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
    <?php
            }
        } else {
            echo "<img style='margin-left:38%;' src='images/noresult.jpg' alt='no result found'";
        }
    }
    ?>


    <!-- About Section -->
    <div class=" container my-5" style="padding-top:5%;">
        <div class="about row">
            <div class="col-md-4 col-5 text-center ">
                <h5 class="text-light" style="font-size:1.8em;">Help & Information</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">About Us</a></li>
                    <li class="my-5"><a class="text-light" href="#">Privacy Policy</a></li>
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-3 text-center">
                <h5 class="text-light" style="font-size:1.8em;">About Us</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                    <li class="my-5"><a class="text-light" href="#">Contact</a></li>
                    <li class="my-5"><a class="text-light" href="#">Home Page</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-3 text-center">
                <h5 class="text-light" style="font-size:1.8em;">Categories</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">Privacy Policy</a></li>
                    <li class="my-5"><a class="text-light" href="#">Home Page</a></li>
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="js/scriptnavimg.js"></script>

</body>

</html>