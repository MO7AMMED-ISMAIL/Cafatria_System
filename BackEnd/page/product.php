<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
        crossorigin="anonymous"
    />

    <title>Product</title>
    <style>
        * {
            /* border: 1px solid red; */
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        nav li a {
            color: black;
            text-decoration: none;
        }
        #admin {
            color: blue;
            text-decoration: underline;
        }
        nav li a:hover {
            color: cadetblue;
            cursor: pointer;
            text-decoration: underline;
        }
        #admin:hover {
            color: red;
        }
    </style>
</head>
<body>
<nav class="container-fluid bg-light" style="height: 10vh">
    <div class="row">
        <div class="col-5">
            <ul
                class="d-flex list-unstyled justify-content-between"
                style="margin-top: 2.5vmin"
            >
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Manual Order</a></li>
                <li><a href="#">Checks</a></li>
            </ul>
        </div>
        <div class="col-3 offset-4 d-flex justify-content-start mt-1">
            <img src="file2.jpg" alt="" style="width: 60px; height: 60px" />
            <a href="#" class="mt-3 ml-3" id="admin">Admin</a>
        </div>
    </div>


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
</nav>

<script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"
></script>
</body>
</html>
