<?php


echo "<h3 style='margin-left: 60vmin; font-weight: bold; margin-bottom: 10vmin'>Update Product </h3>";

if (isset($_SESSION["message"])){
    echo "<p style='color: {$_SESSION['color']} ;'>";
    echo $_SESSION["message"];
    echo "</p>";
    unset($_SESSION["message"]);
    unset($_SESSION["color"]);
}

$productId = $_GET['edit'];
$cond = "id = $productId";
$SelectProduct = $table->Select(["*"],$cond);
$selectedProduct= $SelectProduct->fetch(PDO::FETCH_ASSOC);
//echo "<pre>";
//var_dump($selectedProduct);
//echo "</pre>";
?>

<form style="margin-left: 5vmin" action="page/update.php" method="post" enctype="multipart/form-data">
    <div style="margin-top: 5vmin">
        <label for="id">ID</label>
        <input type="text" readonly name="id" id="id" value="<?=$selectedProduct['id']?>" required />
    </div>
    <div style="margin-top: 5vmin">
        <label for="name">Product</label>
        <input type="text" name="name" id="name" required value="<?=$selectedProduct['name']?>" />
    </div>
    <div style="margin-top: 5vmin">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="<?=$selectedProduct['description']?>" required />
    </div>
    <div style="margin-top: 5vmin">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" min="5" required value="<?=$selectedProduct['price']?>" />
    </div>
    <div style="margin-top: 5vmin">
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php
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
