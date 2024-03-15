<?php
session_start();

require "../../BackEnd/DataBase/DBCLass.php";

use DbClass\Table;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {

        if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
            exit('Token is not set');
        }

        if ($_POST['token'] !== $_SESSION['token']) {
            exit('Token is not valid');
        }

        if (time() >= $_SESSION['token_expire']) {
            exit('Token is expired');
        }


        unset($_SESSION['token']);

        $users = new Table('users');
        // Validate and sanitize input data
        $username = $users->isValidUsername($_POST['username']);
        $email = $users->ValidateEmail($_POST['email']);
        $password = $users->inputData($_POST['password']);
        $repeatPass = $users->inputData($_POST['confirm_password']);
        $room_id = $_POST["room"];
        $img = $users->Upload($_FILES['profile_picture'], '../../BackEnd/uploads/');
        // Check if password and repeat password match
        if ($password !== $repeatPass) {
            throw new Exception("Password and confirm Password do not match");
        }

        // Prepare data for insertion
        $dataInsert = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'profile_picture' => $img,
            'room_id' => $room_id,
        ];


        $users->Create($dataInsert);

        $_SESSION['success_reg'] = "The user Created Successfully";
        header("location:index.php");
        exit();
    } catch (Exception $e) {

        $_SESSION['err'] = $e->getMessage();
        header("location:registerform.php");
        exit();
    }
}
