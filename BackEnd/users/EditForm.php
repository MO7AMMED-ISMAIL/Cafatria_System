<?php
    if(isset($_GET['edit'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        exit();
    }
?>


<div class="row">
    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Update User</h2>
            </div>

            <form action="users/update.php" method="post" class="user" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>

                <!-- ID -->
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?=$userId?>">
                </div>

                <!-- Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelUser['username']?>" name="username">
                </div>
                
                <!-- email -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelUser['email']?>" name="email">
                </div>

                <!-- Room -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Room</span>
                    <input type="number" class="form-control" placeholder="Room..." aria-label="Username" aria-describedby="basic-addon1" name="room" value="<?=$SelUser['room_number']?>">
                </div>

                <!-- EXT -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">EXT</span>
                    <input type="number" class="form-control" placeholder="Etra number..." aria-label="Username" aria-describedby="basic-addon1" name="ext" value="<?=$SelUser['extra_Number']?>">
                </div>

                <!-- image -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Image</span>
                    <input type="file" class="form-control" name="img" aria-label="Username" aria-describedby="basic-addon1"> 
                </div>
                
                <button class="btn btn-primary btn-user btn-block" type="submit">Update</button>
            </form>
            <hr>
            <?php
                if(isset($_SESSION['err'])){
                    echo "<div class='alert alert-danger' role='alert' id='error'>".$_SESSION['err']."</div>";
                    unset($_SESSION['err']);
                }
            ?>
        </div>
    </div>
</div>