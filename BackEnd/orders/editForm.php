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
                <h2 class="h4 text-gray-900 mb-4">Update Order</h2>
            </div>

            <form action="users/update.php" method="post" class="user" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                </div>

                <!-- ID -->
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?=$userId?>">
                </div>

                <!-- username -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">User</span>
                    <select name="product_id" id="" class="form-control">
                        <option value="" >Select User</option>
                        <?php
                        foreach($users_result as $user){
                            echo "<option value='$user[id]'>$user[username]</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- product -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Products</span>
                    <select name="product_id" id="" class="form-control" multiple>
                        <option value="" >Select Product</option>
                        <?php
                            foreach($products_result as $product){
                                echo "<option value='$product[id]'>$product[name]</option>";
                            }
                        ?>
                    </select>
                </div>

                <button class="btn btn-primary btn-user btn-block" type="submit">Update</button>
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