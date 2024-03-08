<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: Auth/LoginForm.php");
    }
    include "./DataBase/DBCLass.php";
    use DbClass\Table;
    $current = "index";
    include "include/sidebar.php";
    include "include/navbar.php";
?>

<div class="container-fluid">
    <div class="row">
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center">
                                <h3 class="mb-1 names">Users-><span>&nbsp;4</span></h3>
                                <p><a class="users mt-3">View Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Admims -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center">
                                <h3 class="mb-1 names">Admin-><span>&nbsp;4</span></h3>
                                <p><a class="users mt-3">View Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow border-left-primary shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-center">
                            <h3 class="mb-1 names">Products-><span>&nbsp;4</span></h3>
                            <p><a class="users mt-3" href="products.php">View Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Orders -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center">
                                <h3 class="mb-1 names">Orders-><span>&nbsp;4</span></h3>
                                <p><a class="users mt-3">View Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Checks -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center">
                                <h3 class="mb-1 names">Users-><span>&nbsp;4</span></h3>
                                <p><a class="users mt-3">View Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php 
    include "include/footer.php";
?>




