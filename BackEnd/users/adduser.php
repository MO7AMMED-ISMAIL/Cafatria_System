<?php

include "../DataBase/DBCLass.php";

use DbClass\Table; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
       
        $table = new Table('users');

        
        $name = $table->inputData($_POST["name"]);
        $email = $table->ValidateEmail($_POST["email"]);
        $password = $table->inputData($_POST["pass"]); 
        $room_no = $table->inputData($_POST["room_number"]);
        $extra_data = $table->inputData($_POST["extra_data"]);
        $img = $table->Upload($_FILES['profile_picture']);
       
        
        $data = array(
            'username' => $name,
            'email' => $email,
            'password' => $password,
            'room_number' => $room_no,
            'extra_data' => $extra_data,
            'profile_picture' => $img 
        );

        
        $result = $table->Create($data);

        if ($result) {
            
            header("location:../users.php");
            exit;
        } else {
            
            echo "Error occurred while adding the user.";
        }
    } catch (Exception $e) {
       
        echo "Error: " . $e->getMessage();
    }
} else {
    
    header('location: addform.php');
    exit;
}
?>
