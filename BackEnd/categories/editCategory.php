<?php
echo "<h2 class='text-center mb-5'>Update Category</h2>";
?>

<form class="container mt-5 needs-validation" action="categories/update.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
        <div class="col-6 mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" class="form-control" value="<?=$selected[0]['id']?>" id="id" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_name" class="form-label">Product</label>
            <input type="text" name="category_name" class="form-control" value="<?=$selected[0]['category_name']?>" id="category_name" required>
            <div class="invalid-feedback">
                Please provide a product name.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_description" class="form-label">Description (Optional)</label>
            <textarea name="category_description" class="form-control" id="category_description" rows="3"><?=$selected[0]['category_description']?></textarea>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-success me-2" type="submit">Save</button>
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
