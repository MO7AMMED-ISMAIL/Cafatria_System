<?php

if (isset($_GET['add'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600;
} else {
    header("Location: ../404.php");
    exit();
}

if (isset($_SESSION["message"])) {
    $messageColor = $_SESSION['color'] ?? 'black';
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
    unset($_SESSION["color"]);
    echo "<div class='alert alert-dismissible fade show' style='color: $messageColor;' role='alert'>
            $message
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}


echo "<h2 class='text-center mb-5'>Add New Product</h2>";
?>

<form class="container mt-5 needs-validation" action="products/AddProduct.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
            <div class="invalid-feedback">
                Please provide a product name.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="price" class="form-control" id="price" step="0.01" required>
            </div>
            <div class="invalid-feedback">
                Please enter a price greater than or equal to 5.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <div class="input-group">
                <select id="category_id" name="category_id" class="form-select" required>
                    <?php
                    if (empty($cat_selected)) {
                        echo "<option value='default' disabled>";
                        echo "default";
                        echo "</option>";
                    } else {
                        if (!is_array($cat_selected)) {
                            // Only one row returned, so convert it to an array
                            $cat_selected = [$cat_selected];
                        }

                        foreach ($cat_selected as $row) {
                            echo "<option value='{$row['id']}'>";
                            echo $row['category_name'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <a class="btn btn-primary" href="categories.php?add=product" id="addCategoryBtn">Add Category</a>
            </div>
            <div class="invalid-feedback">
                Please select a category.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
            <div class="invalid-feedback">
                Please select a status.
            </div>
        </div>
        <div class="col-md-6">
            <label for="product_image" class="form-label">Product Picture</label>
            <input type="file" name="product_image" class="form-control" id="product_image" required>
            <div class="invalid-feedback">
                Please select a product image.
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-success me-2" type="submit">Add Product</button>
        <button class="btn btn-secondary" type="reset">Reset</button>
    </div>
</form>

<script>
    // Simplified validation for all fields using Bootstrap's built-in validation
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
