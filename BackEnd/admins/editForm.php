<?php
    if(isset($_GET['edit'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("location: ../404.php");
        exit();
    }
?>


<div class="row">
    <div class="col-lg-12">
        <div class="p-5">
            <div class="text-center">
                <h2 class="h4 text-gray-900 mb-4">Update Admin</h2>
            </div>
            <form action="admins/update.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?=$AdminId?>">
                </div>

                <!-- Username -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelAdmin['username']?>" name="username">
                </div>
                
                <!-- email -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?=$SelAdmin['email']?>" name="email">
                </div>

                <!-- image -->
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="img" aria-label="Username" aria-describedby="basic-addon1"> 
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