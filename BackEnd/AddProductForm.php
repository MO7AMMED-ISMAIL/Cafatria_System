<?php
session_start();
include "include/sidebar.php";
include "include/navbar.php";
echo "<h3 style='margin-left: 60vmin; font-weight: bold; margin-bottom: 10vmin'>Add New Product</h3>";

if (isset($_SESSION["message"])){
    echo "<p style='color: {$_SESSION['color']} ;'>";
    echo $_SESSION["message"];
    echo "</p>";
    unset($_SESSION["message"]);
    unset($_SESSION["color"]);
}
?>

<form style="margin-left: 5vmin" action="page/AddProduct.php" method="post" enctype="multipart/form-data">
    <div style="margin-top: 5vmin">
        <label for="name">Product</label>
        <input type="text" name="name" id="name" required />
    </div>
    <div style="margin-top: 5vmin">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" required />
    </div>
    <div style="margin-top: 5vmin">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" min="5" required />
    </div>
    <div style="margin-top: 5vmin">
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php
            require("DataBase/DBCLass.php");
            use DbClass\Table;

            $table = new Table("categories");
            $table->conn();

            $selected = $table->Select(["name", "id"]);
            if (!$selected) {
                echo "<option value='default'>";
                echo "default";
                echo "</option>";
            }

            while ($row = $selected->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>";
                echo $row['name'];
                echo "</option>";
            }
            ?>
        </select>
    </div>
    <div style="margin-top: 5vmin">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Available">Available</option>
            <option value="Not Available">Not Available</option>
        </select>
    </div>
    <div style="margin-top: 5vmin; margin-bottom: 2.5vmin">
        <label for="product_image">Product Picture</label>
        <input type="file" name="product_image" id="product_image" required />
    </div>

    <button class="btn btn-success" type="submit">Save</button>
    <button class="btn btn-danger" type="reset">Reset</button>
</form>

<?php
include "include/footer.php"
?>
