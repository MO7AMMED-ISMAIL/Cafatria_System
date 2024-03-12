<?php
    if(isset($_GET['add'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $_SESSION['token_expire'] = time() + 3600 ;
    }else{
        header("location: ../404.php");
        exit();
    }
?>

<div class="row">
    <div class="col-lg-12">
        <div class="text-center">
            <h2 class="h4 text-gray-900 mb-4">Create New Order</h2>
        </div>

        <?php
        if(isset($_SESSION['err'])){
            echo "<div class='row mx-4 px-4 alert alert-danger' role='alert' id='error'>".$_SESSION['err']."</div>";
            unset($_SESSION['err']);
        }
        ?>

        <div class="row px-4 g-4 justify-content-between">
            <div class="col-8">
                <div class="card shadow">
                    <h5 class="card-header text-center">Products</h5>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4 justify-content-start align-items-center mb-3">
                            <?php foreach($products_result as $product) {?>
                                <div class="col product_card" data-product-id="<?=$product['id']?>" data-product-price="<?=$product['price']?>" data-product-name="<?=$product['name']?>">
                                    <div class="card shadow position-relative" style="height:180px">
                                        <img class="card-img-top" style="height: 15vh" src="uploads/<?=$product['picture']?>" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><?=$product['name']?></h5>
                                            <p class="text-center"></p>
                                        </div>
                                        <!-- Badge for each product card -->
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            <?=$product['price']?> $
                                        </span>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <form action="orders/add.php" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="token" value="<?=$_SESSION['token']?>">
                    </div>
                    <div class="card shadow" style="min-height: 60vh;">
                        <h5 class="card-header text-center">Order Details</h5>
                        <div class="card-body">
                            <div id="orderContainer" ></div>

                            <div class="input-group mb-4">
                                <span class="input-group-text" id="basic-addon1">Username</span>
                                <select class="form-control form-select" name="user_id" aria-label="Select user">
                                    <option disabled>Select User</option>
                                    <?php foreach($users_result as $user) {?>
                                        <option value="<?=$user['id']?>"><?=$user['username']?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <!-- room -->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">room</span>
                                <select class="form-control form-select" name="room" aria-label="Select room number">
                                    <option disabled>Select room Number</option>
                                    <?php foreach($rooms_result as $room) {?>
                                        <option value="<?=$room['id']?>"><?=$room['id']?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <labal class="input-group-text" for="notes">Notes</labal>
                                <textarea name="notes" id="notes" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div id="totalPrice"></div>
                            <button type="submit" class="btn btn-sm  btn-primary">Create Order</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

