<?php
session_start();
include "../DataBase/DBCLass.php";
use DbClass\Table; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        
        if(!isset($_POST['token']) || !isset($_SESSION['token'])){
            exit('Token is not set');
            include "../404.php";
        }
    
        if($_POST['token'] == $_SESSION['token']){
            if(time() >= $_SESSION['token_expire']){
                exit('Token is Expired');
                include "../404.php";
            }
            unset($_SESSION['token']);
        }

        $table = new Table('users');
        $name = $table->isValidUsername($_POST["name"]);
        $email = $table->ValidateEmail($_POST["email"]);
        $password = $table->inputData($_POST["pass"]); 
        $room_id = $_POST["room"]; 
        $img = $table->Upload($_FILES['profile_picture']);
        $data = array(
            'username' => $name,
            'email' => $email,
            'password' => $password,
            'profile_picture' => $img,
            'room_id' =>$room_id
        );
        $result = $table->Create($data);
        header("location: ../users.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../users.php?add=User");
        exit();
    }catch(PDOException $e){
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../users.php?add=User");
    }
}
?>
