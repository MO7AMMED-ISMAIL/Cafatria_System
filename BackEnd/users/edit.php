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
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" value="<?=$result['username']?>" placeholder="Name" name="name">
                            </div>
                             <div class="form-group">
                                  <input type="hidden" class="form-control form-control-user" name="id" value="<?=$userId?>">
                              </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" value="<?=$result['email']?>" placeholder="Email" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="room_number" class="form-label">Room Number:</label>
                                <input type="text" class="form-control" id="room_number" value="<?=$result['room_number']?>" placeholder="Room Number" name="room_number">
                            </div>
                            <div class="mb-3">
                                <label for="extra_data" class="form-label">Extra Data:</label>
                                <input type="text" class="form-control" id="extra_data" value="<?=$result['extra_data']?>" placeholder="Extra Data" name="extra_data">
                            </div>
                            <input type="hidden" value="<?=$result['id']?>" name="id">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

