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
    <h4 class="text-center mt-3 display-6 fw-bold">Categories List</h4>

    <a href="categories.php?add=category" class="btn btn-primary mb-3 float-end">Add Category</a>

    <table class="table table-striped table-bordered">
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
                    <a href='categories.php?edit={$selected[$idx]['id']}' class='btn btn-outline-primary'>Update</a>
                    <a href='categories/delete.php?id={$selected[$idx]['id']}' class='btn btn-outline-danger'>Delete</a>
                    </td>";
              echo "</tr>";
          }

          ?>
        </tbody>
    </table>
</div>

