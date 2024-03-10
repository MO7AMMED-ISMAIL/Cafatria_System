<?php
include "../DataBase/DBCLass.php";

use DbClass\Table; 


$table = new Table('users');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $name = $_POST["name"];
    $email = $_POST['email'];
    $room_no=$_POST["room_number"];
    $Extra_Data=$_POST["extra_data"];

    
    try {
        
        $data = array(
            'username' => $name,
            'email' => $email,
            'room_number' => $room_no,
            'extra_data' => $Extra_Data
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
