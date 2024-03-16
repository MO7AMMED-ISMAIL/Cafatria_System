<?php
    use DbClass\Table;
    $newTable = new Table('admins');
    $notificationsTable = new Table('notifications');
    $adminId = $_SESSION['id'];
    $col = ['id', 'username', 'profile_picture','email'];
    $cond = " id = '$adminId'";
    $notifications = $notificationsTable->Select(['*']);
    $currentAdmin = $newTable->FindById('id',$_SESSION['id']);


?>

<div id="body_content" class="flex-fill">
    <!-- bars button of offcanvas-->
    <div class="p-2 d-md-none d-flex text-white bg-info">
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a href="#" class="navbar-brand ms-3 text-center">Cafateria</a><hr>
    </div>


    <div class="p-3">
        <nav class="navbar navbar-expand-lg bg-white shadow rounded p-3 mb-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <li class="nav-item dropdown my-2 me-5 me-lg-0 position-relative">
                    <a class="nav-link p-0 dropdown-toggle" id="notificationBox" href="javascript:void(0);"
                       role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-bell fa-lg"></i>
                    </a>
                    <!-- Badge for each product card -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= $notificationsTable->rowCount('notifications')?></span>

                    <div class="dropdown-menu dropdown-menu-end border-0 p-0 shadow rounded" aria-labelledby="notificationBox" data-bs-popper="static" style="width: 25vw">
                        <h6 class="dropdown-header text-center text-light bg-primary rounded-top p-2 fs-4">
                            Notifications
                        </h6>
                        <!-- Example Alert 1-->
                        <?php
                        try { foreach($notifications as $notification) { ?>
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div>
                                    <?= $notification['type']?>
                                </div>
                                <div class="text-secondary"><?= $notification['created_at']?></div>
                            </a>
                        <?php }
                        } catch (Exception $e) { ?>
                            <div class="col">
                                <img src="./uploads/no-data.gif" alt="" style="width: 80%; height: 50vh;">
                            </div>
                        <?php } ?>
                    </div>

                </li>


                <li class="nav-item dropdown mx-3 me-lg-0">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$currentAdmin['username']?></span>
                        <img class="rounded-circle" src="uploads/<?= $currentAdmin['profile_picture']?>" width="20px" height="20px">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile</a></li>
                        <li><div class="dropdown-divider"></div></li>
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalId"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout</button></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

