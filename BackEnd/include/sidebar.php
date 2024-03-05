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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css"/>
    <!--  font awesome -->
    <link rel="stylesheet" href="css/all.min.css"/>


    <script>
        function activate(parentElement) {

            parentElement.classList.add("active"); // Add the "active" class to the element
        }
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3 page-title">PHP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?=$current == 'index'? 'active':''?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>TEAM</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Admins -->
            <li class="nav-item <?=$current == 'Admins'? 'active':''?>">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fa-solid fa-pen"></i>
                    <span>Admins</span>
                </a>
                <div id="collapseTwo" class="collapse <?=$current == 'Admins'? 'show':''?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item <?=!isset($_GET['add'])== 'Admins'?'active':''?>" href="Admin.php">Display</a>
                        <a class="collapse-item <?=isset($_GET['add'])== 'Admins'?'active':''?>" href="Admin.php?add=Admin"><span style="font-weight:bold">+</span>Add</a>
                    </div>
                </div>
            </li>
            <!-- End Admins -->
            
            <!-- Users -->
            <li class="nav-item <?=$current == 'Users'? 'active':''?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userTogle" aria-expanded="true" aria-controls="userTogle">
                    <i class="fa-solid fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="userTogle" class="collapse  <?=$current == 'Users'? 'show':''?> " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item <?=!isset($_GET['add'])== 'Users'?'active':''?>" href="user.php">Display</a>
                        <a class="collapse-item <?=isset($_GET['add'])== 'Users'?'active':''?>" href="user.php?add=Users"><span style="font-weight:bold">+</span>Add</a>
                    </div>
                </div>
            </li>
            <!-- End Users -->
            

            <!-- Product -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <i class="fa-solid fa-user"></i>
                    <span>Product</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item active"  href="./page/listProducts.php">Display</a>
                        <a class="collapse-item" href="./AddProductForm.php"><span style="font-weight:bold">+</span>Add</a>

                    </div>
                </div>
            </li>
            <!-- End Product -->

            <!-- Category -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <i class="fa-solid fa-user"></i>
                    <span>Category</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item active" href="display-users.html">Display</a>
                        <a class="collapse-item" href="add-user.html"><span style="font-weight:bold">+</span>Add</a>
                    </div>
                </div>
            </li>
            <!-- End Category -->

            <!-- Orders -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <i class="fa-solid fa-user"></i>
                    <span>Orders</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item active" href="display-users.html">Display</a>
                        <a class="collapse-item" href="add-user.html"><span style="font-weight:bold">+</span>Add</a>
                    </div>
                </div>
            </li>
            <!-- End Orders -->




            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->