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
                <h4 class="col text-primary">All Rooms</h4>
                <a href="?add=Room" class="col-2 me-2 btn btn-primary">Add Room</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Extra Data</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   
                        foreach($rooms as $room){
                    ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td><?=$room['room_number']?></td>
                            <td><?=$room['ext']?></td>
                            <td>
                                <a href="?edit=<?=$room['id']?>" class="btn btn-outline-primary">Edit</a>
                                <a href="rooms/delete.php?id=<?=$room['id']?>" class="btn btn-outline-danger">Delete</a>
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