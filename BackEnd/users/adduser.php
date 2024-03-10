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
        $img = $table->Upload($_FILES['profile_picture']);
    
        
        $data = array(
            'username' => $name,
            'email' => $email,
            'password' => $password,
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
    exit();
}
?>
