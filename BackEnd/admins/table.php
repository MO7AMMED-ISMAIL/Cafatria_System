<?php
    if(!isset($_SESSION['id'])){
        header("location: ../404.php");
    }
?>
<div class="container-fluid">
    <?php
    if(isset($_SESSION['success'])){
        echo "<div class='row mx-1 px-4 alert alert-success' role='alert' id='success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }
    ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">All Admins</h4>
                <a href="?add=Admin" class="col-2 me-2 btn btn-primary">Add Admin</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   
                        foreach($result as $admin){
                    ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td><?=$admin['username']?></td>
                            <td><?=$admin['email']?></td>
                            <td><img src="uploads/<?=$admin['profile_picture']?>"></td>
                            <td>
                                <a href="?edit=<?=$admin['id']?>" class="btn btn-outline-warning">Edit</a>
                                <a href="admins/delete.php?id=<?=$admin['id']?>" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</body>

</html>