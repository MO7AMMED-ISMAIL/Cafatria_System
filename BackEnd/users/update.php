<?php
session_start();
include "../DataBase/DBCLass.php";
use DbClass\Table; 
$table = new Table('users');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
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

        $id = $_POST["id"];
        $name = $table->isValidUsername($_POST["name"]);
        $email = $table->ValidateEmail($_POST["email"]);
        $room_id = $_POST["room"]; 

        $data = array(
            'username' => $name,
            'email' => $email,
            'room_id' => $room_id,
        );
        $result = $table->Update($data, 'id', $id);
        $_SESSION["success"]="Successfully Updated";
        header('location: ../users.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['err'] = $e->getMessage();
        header("Location: ../users.php?edit=$id");
        exit();
    }
}else{
    header("Location: ../404.php");
}
?>
