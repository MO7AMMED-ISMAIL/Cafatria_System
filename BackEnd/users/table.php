<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Admins</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Room</th>
                            <th>EXT</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   
                        
                        foreach($result as $user){
                    ?>
                        <tr>
                            <td><?=$id++?></td>
                            <td><?=$user['username']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=$user['room_number']?></td>
                            <td><?=$user['extra_Number']?></td>
                            <td><?=$user['profile_picture']?></td>
                            <td>
                                <a class="btn action" href="users/delete.php?user_id=<?=$user['id']?>">Delete</a>
                                <a class="btn action1" href="?edit=<?=$user['id']?>">Edit</a>
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