<?php

session_start();


if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id']; 
} else {
    
    header('Location: login.php');
    exit();
}


require "class.php"; 
use DbClass\Table; 

$orderTable = new Table('orders');

//latest order for the user
$latestOrderQuery = $orderTable->Select(['*'], 'user_id = ' . $user_id . ' ORDER BY order_date DESC LIMIT 1');
$latestOrder = $latestOrderQuery->fetch(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>

.footer-container {
    padding: 20px;
}

.image-container {
    overflow: hidden;
    width: 100%;
    height: auto;
}

.image-container img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.5s ease, opacity 0.5s ease;
}

.image-container img:hover {
    transform: scale(1.1); 
    opacity: 0.7; 
}


.list-unstyled li a {
            text-decoration: none; 
           
            transition: color 0.3s; 
            font-size: 18px; 
        }
        .list-unstyled li a:hover {
            color: #007bff; 
        }

    </style>
</head>
<body>

 <!--cafe name-->
<div id="Home" class="mainhome jumbotron jumbotron-fluid bg-cover d-flex align-items-center">

<!-- Navigation bar -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark" style="background-color:transparent;">
<div class="container-fluid">
        <div class="row align-items-center">

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
     <div class="col-auto ml-auto">
        <div class="input-group d-none d-lg-flex">
      <form class="input-group d-none d-lg-flex" action="productinfo.php" method="GET">
             <input type="text" id="productNameInput" name="search" class="form-control" placeholder="Search for products...">
        <div class="input-group-append">
          <button id="searchButton" class="lince btn btn-primary" type="submit">Search</button>
        </div>
      </form>

        </div>
     </div>




 <!-- Navigation icon  -->
   <div class="col-auto">
         <button id="navToggle" class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <ul class="navbar-nav" style="margin-top:3%;">
                  <li class="nav-item"  >
                       <a class="nav-link text-light" href="#Home" style="width:100%;">Home</a>
                   </li>

                   <li class="nav-item">
                      <a class="nav-link text-light" href="#Latestorder" style="width:100%;">Latest Order</a>
                   </li>

                    <li class="nav-item">
                       <a class="nav-link text-light" href="#productSection" style="width:100%;">Product</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link text-light" href="order.php" style="width:100%;">My 0rder</a>
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
        <li><a href="#Latestorder">Latest Order</a></li>
        <li><a href="#productSection">Product</a></li>
        <li><a href="order.php">My 0rder</a></li>
    </ul>
   
    <button id="navClose" class="btn btn-outline-light mb-2 ml-2">Close</button>
</div>

    <div class="container">
        <h1 class="display-4 my-5" style="font-style: italic; font-size: 10.7em; color: rgba(237, 243, 246, 0.753);">Cafeto</h1>
        <p class="lead" style="color: rgba(237, 243, 246, 0.753); font-size: 1.5em;">Where every cup tells a story</p>
    </div>
</div>




   <!-- Latest Order Section -->
   <div id="Latestorder" class="container mt-4 my-5">
        <div class="row">
            <h1 class="col-12 my-5 text-center" style="padding: 9%;">Your Latest orders</h1>
        </div>
        <div class="row">
            <div class="card-deck" style="width:100%;">
                <?php 
                
            if ($latestOrder) {
                // order items for the latest order
                 $orderItemsTable = new Table('order_items');
                 $orderItemsQuery = $orderItemsTable->Select(['product_id', 'product_price'], 'order_id = ' . $latestOrder['id']);
                 $orderItems = $orderItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                
                 foreach ($orderItems as $item) {
                 // product details for each order item
                     $productTable = new Table('products');
                     $productQuery = $productTable->Select(['name', 'picture', 'price'], 'id = ' . $item['product_id']);
                     $product = $productQuery->fetch(PDO::FETCH_ASSOC);

                 // Display product
                 if ($product) {
                ?>
                 <div class="col-md-3 col-8 offset-2 offset-md-0 my-5 my-md-0 text-center">
                    <div class="card mb-3" style="max-width: 250px; position: relative;">
                             <img src="images/<?php echo $product['picture']; ?>" class="card-img-top" alt="Product Image">
                         <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <span class="badge bg-success text-light" style="position: absolute; top: 0; right: 0;">Price: $<?php echo $product['price']; ?></span>
                         </div>
                     </div>
                 </div>
                <?php
                        }
                    }
                } else {
                    echo "<p>No orders found.</p>";
                }
                ?>
            </div>
        </div>
    </div>




<!-- Product section -->
<div id="productSection"  class="container mt-4" style="padding-top:9%;">
    <div class="row">

        <!-- Product Table -->
        <div class="col-md-7 col-10 my-md-0 my-5 mx-md-0 mx-5 ">
            <h2>Products</h2>
            <div id="productContainer">
            <?php
                
                $productTable = new Table('products');
               //display product 
             $productQuery = $productTable->Select(['*'], 'status = "Available"');
             $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);

                $itemsPerPage = 9; // 3 items for row, 3 rows
                $numPages = ceil(count($products) / $itemsPerPage);

                $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $startIdx = ($currentPage - 1) * $itemsPerPage;
                $endIdx = $startIdx + $itemsPerPage;

                echo '<div class="row">';
                for ($i = $startIdx; $i < $endIdx && $i < count($products); $i++) {
                    $product = $products[$i];
                    echo '<div class="col-md-4 col-12 my-5">';
                    echo '<div class="card">';
                    echo '<input type="hidden" class="product-id" value="' . $product['id'] . '">';
                    echo '<img src="images/' . $product['picture'] . '" class="card-img-top" alt="Product Image">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $product['name'] . '</h5>';
                    echo '<p class="card-text">Price: ' . $product['price'] . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    if (($i + 1) % 3 == 0) {
                        echo '</div><div class="row">';
                    }
                }
                
                echo '</div>';
                ?>
            </div>
           
           <div class="text-center mt-3">
    <button class="btn btn-primary " id="prevPage">Back</button>
    <button class="btn btn-primary ml-2" id="nextPage">Next</button>
</div>

        </div>



       
   <!-- Order form -->
   <div class="col-md-5 my-5 my-md-0 col-12">
    <h2>Order Details</h2>
    <form id="orderForm" class="order-form formbtn" action="" method="post">
        <div class="form-group">
            <label for="selectedProducts">Selected Products</label>
            <div id="selectedProducts"></div>
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="room">Room</label>
            <select class="form-control" id="room" name="room">
                <?php
                try {
                    $table = new Table('rooms');
                    $roomNumbersQuery = $table->Select(['room_number']);
                    $roomNumbers = $roomNumbersQuery->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($roomNumbers as $room) {
                        echo "<option value='" . $room['room_number'] . "'>" . $room['room_number'] . "</option>";
                    }
                } catch (Exception $e) {
                    echo "<option value=''>Error fetching rooms</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="totalPrice">Total Price</label>
            <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
        </div>

        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <div class="form-group">
            <div class="d-flex flex-column">
                <button type="submit" class="btn btn-primary mb-2" id="orderButton" disabled>Order</button>
                <button type="button" class="btn btn-danger" id="removeAllProducts">Cancel</button>
            </div>
        </div>
    </form>
</div>




 <!-- About Section -->
 <div class=" container my-5" style="padding-top:5%;">
        <div class="about row">
            <div class="col-md-4 col-5 text-center ">
                <h5 class="text-light"style="font-size:1.8em;" >Help & Information</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">About Us</a></li>
                    <li class="my-5"><a class="text-light" href="#">Privacy Policy</a></li>
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-3 text-center">
                <h5 class="text-light"style="font-size:1.8em;">About Us</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                    <li class="my-5"><a  class="text-light" href="#">Contact</a></li>
                    <li class="my-5"><a  class="text-light" href="#">Home Page</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-3 text-center">
                <h5 class="text-light"style="font-size:1.8em;">Categories</h5>
                <ul class="list-unstyled">
                    <li class="my-5"><a class="text-light" href="#">Privacy Policy</a></li>
                    <li class="my-5"><a class="text-light" href="#">Home Page</a></li>
                    <li class="my-5"><a class="text-light" href="#">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>


   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    

    <script>

// Nav Draw Toggle and Close
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navClose = document.getElementById('navClose');
    const sideNav = document.getElementById('sideNav');

    navToggle.addEventListener('click', function() {
        sideNav.style.left = (sideNav.style.left === '0px') ? '-300px' : '0px';
    });

    navClose.addEventListener('click', function() {
        sideNav.style.left = '-300px';
    });
});






// sticky Navbar Scroll
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.pageYOffset >= 100) {
        navbar.classList.add('sticky');
        navbar.style.background="rgb(56, 45, 3)";
    } else {
        navbar.classList.remove('sticky');
        navbar.style.background="transparent";
    }
});


 

//display product at tpage

    document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.getElementById('productContainer');
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');

    const itemsPerPage = 9; // Number of products per page
    let currentPage = <?php echo $currentPage; ?>;
    let numPages = <?php echo $numPages; ?>;
    let products = <?php echo json_encode($products); ?>;

    function displayProducts(page) {
        const startIdx = (page - 1) * itemsPerPage;
        const endIdx = Math.min(startIdx + itemsPerPage, products.length);
        
        let html = '<div class="row">';
        for (let i = startIdx; i < endIdx; i++) {
            const product = products[i];
            html += '<div class="col-md-4">';
            html += '<div class="card">';
            html += '<img src="images/' + product.picture + '" class="card-img-top" alt="Product Image">';
            html += '<div class="card-body">';
            html += '<h5 class="card-title">' + product.name + '</h5>';
            html += '<p class="card-text">Price: ' + product.price + '</p>';
            html += '</div>';
            html += '<div class="card-footer">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        html += '</div>';
        productContainer.innerHTML = html;

        // Disable or enable previous and next button
        if (currentPage === 1) {
            prevButton.disabled = true;
        } else {
            prevButton.disabled = false;
        }

        if (currentPage === numPages) {
            nextButton.disabled = true;
        } else {
            nextButton.disabled = false;
        }
    }

    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            displayProducts(currentPage);
        }
    });

    nextButton.addEventListener('click', function() {
        if (currentPage < numPages) {
            currentPage++;
            displayProducts(currentPage);
        }
    });

    displayProducts(currentPage);
});


//change background image
document.addEventListener('DOMContentLoaded', function() {
    var images = ["images/home-1-slider-image-3.jpg", "images/home-1-slider-image-1.jpg", "images/home-1-slider-image-2.jpg"];

     var index = 0;
    var mainhome = document.querySelector('.mainhome');

    
    function changeBackground() {
        mainhome.style.transition = "background-image 2s ease";
        mainhome.style.backgroundImage = "url('" + images[index] + "')";
        index = (index + 1) % images.length;
    }

   
    changeBackground();

    
    setInterval(changeBackground, 6000); 
});


</script>

   
<script src="script.js"></script>


</body>
</html>