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

$categoryTable = new Table('categories');
$categoryDataQuery = $categoryTable->Select(['id', 'category_name']);
$categories = $categoryDataQuery->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
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
                                echo '<img id="userimg" src="images/' . $userData['profile_picture'] . '" alt="User Image" class="img-fluid rounded-circle mr-2">';
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
            <h1 class="display-4 my-5" style="font-style: italic; font-size: 10.7em; color: rgba(237, 243, 246, 0.753);">Menu</h1>
            <div id="slogann">
                <p id="sloganText" class="lead" style="color: rgba(237, 243, 246, 0.753); font-size: 1.5em;">Discover Delight, Taste the Moment: Your Café, Your Culinary Journey!</p>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="container-fluid my-5">
        <div class="row">
            <div class="accordion accordion-flush col-12" id="accordionFlushExample">
                <?php
                foreach ($categories as $index => $category) {
                    echo '<div class="accordion-item">';
                    echo '<h2 class="accordion-header">';
                    echo '<button id="accordionButton' . $category['id'] . '" style="background-color:rgba(71, 44, 8, 0.816);" class="accordion-button text-light ' . ($index === 0 ? 'active' : '') . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $category['id'] . '">';
                    echo $category['category_name'];
                    echo '</button>';
                    echo '</h2>';
                    echo '<div id="collapse' . $category['id'] . '" class="accordion-collapse collapse ' . ($index === 0 ? 'show' : '') . '">';
                    echo '<div class="accordion-body">';

                    //  products related to category
                    $productTable = new Table('products');
                    $productQuery = $productTable->Select(['id', 'name', 'description', 'price', 'picture'], 'category_id = ' . $category['id']);
                    $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);

                    //products in row of three
                    echo '<div class="row">';
                    $counter = 0;
                    foreach ($products as $product) {
                        echo '<div class="col-md-4 col-4">';
                        echo '<div class="row">';
                        echo '<div class="col-md-6 col-7">';
                        echo '<img src="images/' . $product['picture'] . '" class="img-fluid" alt="Product Image">';
                        echo '</div>';
                        echo '<div class="col-md-6 my-md-5 ">';
                        echo '<h4>' . $product['name'] . '</h4>';
                        echo '<p>' . $product['description'] . '</p>';
                        echo '<p id="price"><strong>Price:</strong> $' . $product['price'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $counter++;
                        if ($counter % 3 == 0) {
                            echo '</div><br><div class="row">';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/scriptnavimg.js"></script>

</body>

</html>
