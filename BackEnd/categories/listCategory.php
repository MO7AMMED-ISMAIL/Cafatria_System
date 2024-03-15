<?php
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

if (!isset($_SESSION['id'])) {
    if (!isset($_SESSION['id'])) {
        header("location: ../404.php");
    }
}

?>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">All Categories</h4>
                <a href="categories.php?add=category" class="col-2 me-2 btn btn-primary">Add Category</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Created At</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="categoryTableBody">
                    <?php

                    foreach ($selected as $idx=> $rows){
                        echo "<tr>";
                        foreach ($rows as $key=>$value){
                            echo "<td class='text-center' scope='col'>";
                            echo "$value";
                            echo "</td>";
                        }
                        echo "<td class='d-flex justify-content-around'>
                        <a href='categories.php?edit={$selected[$idx]['id']}' class='btn btn-outline-warning'>Edit</a>
                        <a href='categories/delete.php?id={$selected[$idx]['id']}' class='btn btn-outline-danger'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

