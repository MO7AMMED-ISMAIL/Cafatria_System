<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="?add=Room" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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