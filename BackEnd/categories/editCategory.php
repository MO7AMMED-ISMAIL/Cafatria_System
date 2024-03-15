<?php
echo "<h2 class='text-center mb-5'>Update Category</h2>";


// Check if 'id' parameter is set in the URL
if(isset($_GET['edit'])) {
    $catSelected=$table->Select(['*'],"id={$_GET['edit']}")->fetch(PDO::FETCH_ASSOC);
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600 ;
}else{
    header("Location: ../404.php");
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

?>

<form class="container mt-5 needs-validation" action="categories/update.php" method="post">
    <div class="row">
        <!-- Token -->
        <div class="form-group">
            <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
        </div>

        <div class="col-6 mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" class="form-control" value="<?=$catSelected['id']?>" id="id" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_name" class="form-label">Product</label>
            <input type="text" name="category_name" class="form-control" value="<?=$catSelected['category_name']?>" id="category_name" required>
            <div class="invalid-feedback">
                Please provide a product name.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="category_description" class="form-label">Description (Optional)</label>
            <textarea name="category_description" class="form-control" id="category_description" rows="3"><?=$catSelected['category_description']?></textarea>
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
