<?php
    // Check if 'id' parameter is set in the URL
    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("Location: ../404.php");
    }
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit User</h5>
                        <form action="users/update.php" method="post">
                            <!-- Token -->
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                            </div>

                            <!-- ID -->
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-user" name="id" value="<?=$userId?>">
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" value="<?=$result['username']?>" placeholder="Name" name="name">
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" value="<?=$result['email']?>" placeholder="Email" name="email">
                            </div>

                            <!-- Rooms -->
                            <div class=" mb-3">
                                <label class="form-label">Room:</label>
                                <select class="form-select" name="room">
                                    <?php
                                        foreach ($rooms as $room){
                                    ?>
                                    <option value="<?= $room['id']?>" <?=$result['room_id']==$room['id']?'Selected':''?>>
                                        <?= $room['room_number']?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Update</button>
                        </form>

                        <?php
                            if(isset($_SESSION['err'])){
                                echo "<div class='alert alert-danger' role='alert' id='error'>".$_SESSION['err']."</div>";
                                unset($_SESSION['err']);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

