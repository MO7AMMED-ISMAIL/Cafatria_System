<?php
    if(isset($_GET['edit'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("Location: ../404.php");
        exit();
    }
?>


<div class="row">
    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Update Admin</h2>
            </div>
            <form action="rooms/update.php" method="post">
                <!-- token -->
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>
                <!-- ID -->
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?=$RoomId?>">
                </div>

                <!-- Room Number -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control" placeholder="plz Enter Room Number" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelRoom['room_number']?>" name="room_number">
                </div>
                
                <!-- EXt -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelRoom['ext']?>" name="ext">
                </div>

                <button class="btn btn-primary w-25 d-block m-auto" type="submit">Update</button>
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