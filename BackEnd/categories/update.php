<?php
session_start();
require("../DataBase/DBCLass.php");

use DbClass\Table;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    try {
        if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
            exit('Token is not set');
            include "../404.php";
        }

        if ($_POST['token'] == $_SESSION['token']) {
            if (time() >= $_SESSION['token_expire']) {
                exit('Token is Expired');
                include "../404.php";
            }
            unset($_SESSION['token']);
        }

        $table = new Table("categories");

        $currentDate = date("Y-m-d H:i:s");
        echo $currentDate;

        $posted['category_name'] = $_POST['category_name'];
        $posted['category_description'] = $_POST['category_description'];
        $posted['created_at'] = $currentDate;

        $table->Update($posted, 'id', $_POST['id']);


//successfully updated
        $_SESSION['message']="successfully updated";
        $_SESSION['color']="green";
        header("Location:../categories.php");
    }
    catch (Exception $e){
        $_SESSION['message']="error while update please try again";
        $_SESSION['color']="red";
        header("../categories.php?edit={$_POST['id']}");
    }
}else{
    header("Location: ../404.php");
}
