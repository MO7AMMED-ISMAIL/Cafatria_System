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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <h4 class="col text-primary">All Products</h4>
                <a href="?add=Room" class="col-2 me-2 btn btn-primary">Add Product</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Category</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $selected->fetch(PDO::FETCH_ASSOC)) {
                        $statusColor = ($row['status'] == "Available") ? "darkgoldenrod" : "red";
                        echo "<tr>";
                        echo "<td scope='col' class='text-center'>{$row['name']}</td>";
                        echo "<td scope='col' class='text-center'>{$row['category_name']}</td>";
                        echo "<td scope='col' class='text-center' style='color:$statusColor; font-weight: bold'>{$row['status']}</td>";
                        echo "<td scope='col' class='text-center'>{$row['description']}</td>";
                        echo "<td scope='col' class='text-center' style='color: #0a930a; font-weight: bold'>{$row['price']}$</td>";
                        echo "<td scope='col' class='text-center'>
                            <div class='btn-group' role='group'>
                                <a href='products.php?edit={$row['id']}' class='btn btn-outline-primary'>Update</a>
                                <a href='products/delete.php?id={$row['id']}' class='btn btn-outline-danger'>Delete</a>
                            </div>
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
