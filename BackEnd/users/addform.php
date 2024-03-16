<?php
    if(isset($_GET['add'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("Location: ../404.php");
        exit();
    }
?>

    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Add New User</h2>
            </div>
            <?php
            if(isset($_SESSION['err'])){
                echo "<div class='alert alert-danger' role='alert' id='error'>".$_SESSION['err']."</div>";
                unset($_SESSION['err']);
            }
            ?>
            <form action="users/adduser.php" method="post" class="user" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>

                <!-- Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="name">
                </div>
                
                <!-- email -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="email" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="email">
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="pass">
                </div>

                <!-- Rooms -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Room</span>
                    <select class="form-select"  name="room">
                        <option>Choose The Rooms</option>
                        <?php
                            foreach ($rooms as $room){
                        ?>
                        <option value="<?= $room['id']?>">
                            <?= $room['room_number']?>
                        </option>
                        <?php }?>
                    </select>
                </div>

                <!-- image -->
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="profile_picture" aria-label="Username" aria-describedby="basic-addon1"> 
                </div>

                <button type="submit" class="btn btn-primary d-block m-auto w-25">Save</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </form>
            <hr>
        </div>
    </div>
</div>

