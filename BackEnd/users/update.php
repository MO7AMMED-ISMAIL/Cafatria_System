<?php
include "../DataBase/DBCLass.php";

use DbClass\Table; 


$table = new Table('users');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST['email'];
    
    try {
        $data = array(
            'username' => $name,
            'email' => $email,
        );
        $result = $table->Update($data, 'id', $id);

        if ($result) {
            header('location:../users.php');
            exit;
        } else {
            echo "Error occurred while updating data.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request. Missing user ID.";
}
?>
