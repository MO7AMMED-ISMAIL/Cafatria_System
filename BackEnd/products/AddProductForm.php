<?php
echo "<h4 class='display-5 text-center mb-5'>Add New Product</h4>";
?>

<form class="container mt-5 needs-validation" style="overflow: scroll" action="products/AddProduct.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Product</label>
            <input type="text" name="name" class="form-control" id="name" required>
            <div class="invalid-feedback">
                Please provide a product name.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description">
            <!-- No validation for description field -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" min="5" required>
            <div class="invalid-feedback">
                Please enter a price greater than or equal to 5.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <div class="input-group">
                <select id="category_id" name="category_id" class="form-select" required>
                    <?php
                    $selected = $table->Select(["name", "id"]);

                    if (empty($selected)) {
                        echo "<option value='default' disabled>";
                        echo "default";
                        echo "</option>";
                    } else {
                        if (!is_array($selected)) {
                            // Only one row returned, so convert it to an array
                            $selected = [$selected];
                        }

                        foreach ($selected as $row) {
                            echo "<option value='{$row['id']}'>";
                            echo $row['name'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <button class="btn btn-primary" type="button" id="addCategoryBtn">Add Category</button>
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
    <button class="btn btn-success me-2" type="submit">Save</button>
    <button class="btn btn-danger" type="reset">Reset</button>
</form>

<script>
    // Custom validation for fields excluding description
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    // Validate only non-description fields
                    var descriptionField = document.getElementById('description');
                    if (!descriptionField.value) {
                        descriptionField.classList.remove('is-valid');
                        descriptionField.classList.add('is-invalid');
                    } else {
                        descriptionField.classList.remove('is-invalid');
                        descriptionField.classList.add('is-valid');
                    }

                    form.classList.add('was-validated');
                }, false);
            });

        // Add Category Button Click Event
        document.getElementById('addCategoryBtn').addEventListener('click', function() {
            // Your code to handle adding a new category goes here
        });
    })();
</script>
