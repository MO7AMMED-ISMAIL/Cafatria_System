<?php
    if(isset($_GET['add']) == 'Admin'){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("location: ./users.php");
        exit();
    }
?>

    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Add New User</h2>
            </div>
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
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="email">
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="pass">
                </div>
                 <!---confirm pass-->
                 <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="pass">
                </div>

                <!--room_number--->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">RoomNumber</span>
                    <input type="text" class="form-control" placeholder="RoomNumber" aria-label="Username" aria-describedby="basic-addon1" name="room_number">
                </div>
                <!----extra_Data--->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">ExtraData</span>
                    <input type="text" class="form-control" placeholder="ExtraData" aria-label="Username" aria-describedby="basic-addon1" name="extra_data">
                </div>
                <!-- image -->
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="profile_picture" aria-label="Username" aria-describedby="basic-addon1"> 
                </div>

                <button type="submit" class="btn btn-primary d-block m-auto w-25">ADD</button>
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

