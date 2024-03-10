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
?>


<div class="container">
    <h3 class="text-center text-dark" style="font-weight: bolder">Products</h3>
    <a class="btn btn-success mt-3 mb-4 text-decoration-none text-white" href="./products.php?add=product">Add New Product</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $selected->fetch(PDO::FETCH_ASSOC)) {
                $statusColor = ($row['status'] == "Available") ? "darkgoldenrod" : "red";
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['category_name']}</td>";
                echo "<td style='color:$statusColor; font-weight: bold'>{$row['status']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td style='color: #0a930a; font-weight: bold'>{$row['price']}$</td>";
                echo "<td>
                            <div class='btn-group' role='group'>
                                <a href='products.php?edit=1' class='btn btn-outline-primary m-1'>Update</a>
                                <a href='#' class='btn btn-outline-danger m-1'>Delete</a>
                            </div>
                    </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
