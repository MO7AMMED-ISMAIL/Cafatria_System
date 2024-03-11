<?php
echo "<h2 class='text-center mb-5'>Add New Category</h2>";
?>

<form class="container mt-5 needs-validation" action="categories/AddCategory.php" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Product</label>
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

    <div class="d-flex justify-content-end">
        <button class="btn btn-success me-2" type="submit">Add Category</button>
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
