<?php
    if(isset($_GET['show'])){
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
                <h2 class="h4 text-gray-900 mb-4">Order Details</h2>
            </div>

            <div class="col">
                <div class="card shadow">
                    <h5 class="card-header text-center">Products</h5>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4 justify-content-start align-items-center mb-3">
                            <?php
                            foreach($orderItems as $orderItem) {?>
                                <?php $product = $products->FindById('id',$orderItem['product_id']);
                                if ($product) {?>
                                    <div class="col product_card">
                                        <div class="card shadow position-relative" style="height:200px">
                                            <img class="card-img-top" style="height: 15vh" src="uploads/<?=$product['picture']?>" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-center"><?=$product['name']?></h5>
                                                <p class="badge text-bg-secondary"><?=$orderItem['quantity']?></p>
                                            </div>
                                            <!-- Badge for each product card -->
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                <?=$orderItem['product_price']?> $
                                            </span>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php }?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <div>
                            <span class="text-danger fs-4">Total Price = </span>
                            <span class="badge text-bg-success fs-4"><?=$SelOrder['total_price']?> $</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>