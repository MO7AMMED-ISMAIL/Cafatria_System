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


<div class="container">
    <h3 class="text-center display-6 text-dark" style="font-weight: bolder">Products List</h3>
    <a class="btn btn-primary mt-1 mb-2 text-decoration-none col offset-10 text-white" href="./products.php?add=product">Add Product</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered ">
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
