<h3 class="text-center text-dark font-weight-bold">Products</h3>
<?php

$color = "text-danger font-weight-bold";

echo "<div class='container-fluid'>";
echo "<table class='table table-striped'>";
echo "<thead>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Category</th>";
echo "<th>Status</th>";
echo "<th>Description</th>";
echo "<th>Price</th>";
echo "<th>Action</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $selected->fetch(PDO::FETCH_ASSOC)) {
    //$innerJoinSelected=$table->SelectInnerJoinTable("categories",["name"],["id"],"categories.id=products.category_id and categories.id={} ");

    if ($row['status'] == "Available") {
        $color = "text-success font-weight-bold";
    }
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['category_id']}</td>";
    echo "<td class='$color'>{$row['status']}</td>";
    echo "<td>{$row['description']}</td>";
    echo "<td class='text-info'>{$row['price']} EGP</td>";
    echo "<td>";
    echo "<button class='btn-primary btn w-75' onclick='handleUpdate({$row['id']})'>Update</button>";
    echo "<button class='btn-danger btn mt-1 w-75' onclick='handleDelete({$row['id']})'>Delete</button>";
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</div>";
?>
