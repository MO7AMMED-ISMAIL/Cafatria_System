<?php
// Check if 'id' parameter is set in the URL
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
}
?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit User</h5>
                        <form action="users/update.php" method="post">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" value="<?=$result['username']?>" placeholder="Name" name="name">
                            </div>
                            <!-- ID -->
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-user" name="id" value="<?=$userId?>">
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" value="<?=$result['email']?>" placeholder="Email" name="email">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

