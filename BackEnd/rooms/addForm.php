<?php
    if(isset($_GET['add']) == 'Room'){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("Location: ../404.php");
    }
    
?>

<div class="row">
    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Create New Admin</h2>
            </div>
            <form action="rooms/add.php" method="post" class="user">
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>

                <!-- Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Room Number</span>
                    <input type="text" class="form-control" placeholder="Plz Enter Room Number" aria-describedby="basic-addon1" name="room_number">
                </div>
                
                <!-- EXT -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Extra Data</span>
                    <input type="text" class="form-control" placeholder="Plz Enter Extra Data" aria-describedby="basic-addon1" name="ext">
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

