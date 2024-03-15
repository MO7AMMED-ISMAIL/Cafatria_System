<?php
    if(!isset($_SESSION['id'])){
        if(!isset($_SESSION['id'])){
        header("location: ../404.php");
    }
    if(isset($_SESSION['success'])){
        $message = $_SESSION["success"];
        $messageColor="green";
        unset($_SESSION["message"]);
        echo "<div class='alert alert-dismissible fade show' style='color: $messageColor;' role='alert'>
            $message
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">All Users</h4>
                <a href="?add=User" class="col-2 me-2 btn btn-primary">Add User</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Room</th>
                        <th>Ext</th>
                        <th>Img</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($users as $user){

                        ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td>
                                <?= $user['username'] ?>
                            </td>
                            <td>
                                <?= $user['email'] ?>
                            </td>
                            <?php
                            $userRoom = $room->FindById('id', $user['room_id']);
                            $userExt = $room->FindById('id', $user['room_id']);
                            ?>
                            <td>
                                <a href=""><?= $userRoom['room_number']?></a>
                            </td>

                            <td>
                                <?= $userExt['ext']?>
                            </td>

                            <td>
                                <img src="uploads/<?= $user['profile_picture'] ?>" style="max-width:50px; max-height:50px;">
                            </td>

                            <td>
                                <a href="?edit=<?=$user['id']?>" class='btn btn-outline-warning btn-sm'>Edit</a>
                                <a href='users/delet.php?id=<?=$user['id'] ?>' class='btn btn-outline-danger btn-sm'>Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
</html>