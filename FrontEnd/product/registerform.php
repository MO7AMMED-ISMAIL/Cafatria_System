<?php

require "../../BackEnd/DataBase/DBCLass.php";

use DbClass\Table;

session_start();

$_SESSION['token'] = bin2hex(random_bytes(32));
$_SESSION['token_expire'] = time() + 3600;

$roomTable = new Table('rooms');
$rooms = $roomTable->Select(['id', 'room_number']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/registerform.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card registercontainer col-12">
                <div class="card-header ">
                    <h2 class="mb-4 my-4">Create an Account</h2>
                </div>
                <div class="card-body">
                    <form action="register.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>

                        <!------>

                        <!-- Rooms -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Room</span>
                            <select class="form-select" name="room">
                                <option>Choose The Rooms</option>
                                <?php
                                foreach ($rooms as $room) {
                                ?>
                                    <option value="<?= $room['id'] ?>">
                                        <?= $room['room_number'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-block w-50">Register</button>
                        </div>
                    </form>
                    <?php if (isset($_SESSION['err'])) : ?>
                        <div class="alert alert-danger mt-3"><?= $_SESSION['err']; ?></div>
                        <?php unset($_SESSION['err']); ?>
                    <?php endif; ?>
                    <hr>
                    <div class="text-center">
                        Already have an account?<a class="small" href="login.php"> Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>