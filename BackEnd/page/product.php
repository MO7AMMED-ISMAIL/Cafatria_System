<?php
include "../include/sidebar.php";
include "../include/navbar.php";
?>

<?php


 if (isset($_COOKIE["error"])){
        echo "<p style='color: {$_COOKIE['color']}'>";
        echo $_COOKIE["error"];
        echo "</p>";
        setcookie("error","",time()-3600);
        setcookie("color","",time()-3600);
    }
    if (isset($_COOKIE["success"])){
        echo "<p style='color: {$_COOKIE['color']}'>";
        echo $_COOKIE["success"];
        echo "</p>";
        setcookie("success","",time()-3600);
        setcookie("color","",time()-3600);
    }
    ?>
    <form action="AddProduct.php" method="post" enctype="multipart/form-data">
        <label for="name">Product</label>
        <input type="text" name="name" id="name" required />
        <label for="description">Product</label>
        <input type="text" name="description" id="description" required />
        <label for="price">Price</label>
        <input type="number" name="price" id="price" min="5" required />

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php

            require ("../DataBase/DBCLass.php");
            use DbClass\Table;

            $table= new Table("categories");
            $table->conn();


              $selected=$table->Select(["name","id"]);
              if(!$selected){
                 echo "<option value='default'>";
                 echo "default";
                 echo "</option>";
              }

                while($row=$selected->fetch(PDO::FETCH_ASSOC)){
                echo"<option value='{$row['id']}'>";
                echo $row['name'];
                echo "</option>";
            }

            ?>

        </select>

         <a href="#">Add Category</a>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Available">Available</option>
            <option value="Not Available">Not Available</option>
        </select>
        <label for="product_image">Product Picture</label>
        <input
            type="file"
            name="product_image"
            id="product_image"
            required
        />

        <button class="btn btn-success" type="submit">save</button>
        <button class="btn btn-danger" type="reset">reset</button>
    </form>

 <?php
 include "../include/footer.php"
 ?>