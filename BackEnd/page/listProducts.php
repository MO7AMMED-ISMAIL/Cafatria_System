<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASPS Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/mystyle.css"/>
    <!--  font awesome -->
    <link rel="stylesheet" href="../css/all.min.css"/>


    <script>
        function activate(parentElement) {

            parentElement.classList.add("active"); // Add the "active" class to the element
        }
    </script>

</head>

<body>

<h3 class="text-center text-dark font-weight-bold">Products</h3>
<?php
include("../DataBase/DBCLass.php");
use DbClass\Table;


$table = new Table("products");
$table->conn();

$selected=$table->Select(["*"]);

$color="text-danger";


echo "<div class='container-fluid d-flex justify-content-between flex-row flex-wrap'>";
while ($row=$selected->fetch(PDO::FETCH_ASSOC)) {
   if($row['status']=="Available"){
       $color="text-success";
   }
    echo "<div class='row'>
    <div class='col-4 mt-3'>
        <div class='card' style='width: 18rem'>
            <img class='card-img-top h-50' style='height: 50%; width: 100$' src='product_images/{$row['picture']}'/>

            <div class='container'>
                <div class='row'>
                    <p class='col h5 fw-bold'>{$row['name']}</p>
                    <p class='col-auto fw-bolder'>{$row['category_id']}</p>
                </div>
                <div class='row'>
                    <p class='col $color'>{$row['status']}</p>
                    <p class='col-auto fw-bold'>{$row['description']}</p>
                </div>
                <div class='row'>
                    <p class='col text-info'>price:{$row['price']} EGP</p>
                    <button class='btn btn-primary mr-1 h-50 col-auto'>Update</button>
                    <button class='btn btn-danger col-auto h-50'>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>";
}
echo "</div>";
?>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>


</body>

</html>