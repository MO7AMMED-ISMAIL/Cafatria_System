<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        body {
           
            background-color: #f8f9fa;
            
        }
        
    </style>
</head>
<body>

<!--cafe name-->
<div class="mainhome jumbotron jumbotron-fluid bg-cover d-flex align-items-center" style="height:50vh;">

<!-- Navigation bar -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark" style="background-color:transparent;">
    <div class="container-fluid">
        <div class="row align-items-center">

  <!-- Navigation icon  -->
     <div class="col-auto">
         <button id="navToggle" class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
             </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav" style="margin-top:3%;">
                        <li class="nav-item"  >
                            <a class="nav-link text-light" href="index.php #Home" style="width:100%;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php #Latestorder" style="width:100%;">Latest Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php #productSection" style="width:100%;">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="index.php #Myproduct" style="width:100%;">My Product</a>
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
         <li><a href="index.php #Home">Home</a></li>
        <li><a href="index.php #Latestorder">Latest Order</a></li>
        <li><a href="index.php #productSection">Product</a></li>
        <li><a href="index.php #Myproduct">My Product</a></li>
    </ul>
   
    <button id="navClose" class="btn btn-outline-light mb-2 ml-2">Close</button>
</div>


<div class="container">
        <h1 class="display-4 my-5" style="font-style: italic; font-size: 10.7em; color: rgba(237, 243, 246, 0.753);">Cafeto</h1>
        <p class="lead" style="color: rgba(237, 243, 246, 0.753); font-size: 1.5em;">Where every cup tells a story</p>
    </div>
</div>



<?php
require_once 'class.php'; 
use DbClass\Table; 

$table = new Table('products');


if(isset($_GET['search'])) {
    $search = $_GET['search'];

    
    $selected= $table->Select(['*'], "status = 'Available' AND name LIKE '$search'");
    $selectedProduct = $selected->fetch(PDO::FETCH_ASSOC);
    
    if (!empty($selectedProduct)) {
?>
        <div class="row my-5 text-center">
            <div class="card mx-auto col-md-5 col-12 maincard">
                <img src="images/<?php echo $selectedProduct['picture']; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $selectedProduct['name']; ?></h5>
                    <p class="card-text">Price: <?php echo $selectedProduct['price']; ?></p>
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
                    <h2 class="text-center mt-5 my-5">Related Products</h2>
                </div>

                <div class="row text-center">
<?php
                    foreach ($relatedProducts as $row) {
?>
                        <div class="col-md-3 col-10 offset-2 offset-md-0  text-center my-5">
                            <div class="card cardss">
                                <img src="images/<?php echo $row['picture']; ?>" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <p class="card-text">Price: <?php echo $row['price']; ?></p>
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
        echo "<p class='text-center'>No products found.</p>";
    }           
}
?>


   <!-- Order form -->
        <div class="container my-5" style="margin-top:50%;">
            <h2>My orders</h2>
            <form id="orderForm" class="order-form col-10 col-md-12 offset-1 offset-md-0">
        <div class="form-group">

            <label for="selectedProducts">Selected Products</label>
            <div id="selectedProducts"></div>

        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="3"></textarea>
        </div>
        
        
        <div class="form-group">
    <label for="room">Room</label>
    <select class="form-control" id="room">
        <?php
       
       
        try {
            
            $table = new Table('rooms');

            
            $roomNumbersQuery = $table->Select(['room_number']);
            $roomNumbers= $roomNumbersQuery->fetchAll(PDO::FETCH_ASSOC);
            

            
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
            <input type="text" class="form-control" id="totalPrice" readonly>
        </div>
       
        
  <div class="form-group">
    <div class="d-flex flex-column">
        <button type="submit" class="btn btn-primary mb-2" id="orderButton" disabled>Order</button>
        <button type="button" class="btn btn-danger" id="removeAllProducts">Clear All</button>
    </div>
  </div>

  </form>
</div>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-primary" style="margin-right:90%;">Back</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>

   document.addEventListener('DOMContentLoaded', function() {
    var images = ["images/home-1-slider-image-3.jpg", "images/home-1-slider-image-1.jpg", "images/home-1-slider-image-2.jpg"]; 

    var index = 0;
    var mainhome = document.querySelector('.mainhome');

    //  change the background image
    function changeBackground() {
        mainhome.style.transition = "background-image 2s ease";
        mainhome.style.backgroundImage = "url('" + images[index] + "')";
        index = (index + 1) % images.length;
    }

    
    changeBackground();

   
    setInterval(changeBackground, 6000); 
});



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



//sticky Navbar Scroll
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
    </script>
    <script src="script.js"></script>

</body>
</html>
