<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: Auth/LoginForm.php");
    }
    $current = 'Admin';
    $id = 1 ;
    include "include/sidebar.php";
    include "include/navbar.php";
    include "DataBase/DBCLass.php";
    use DbClass\Table;

    try{
        $admins = new Table('admins');
        $col = ['id','username','email','profile_picture','created_at'];
        $result = $admins->Select($col);
    }catch(Exception $e){
        $result = [];
    }

    if(isset($_GET['add']) == 'Admin'){
        include "admins/addForm.php";
    }
    elseif(isset($_GET['edit'])){
        $AdminId = $_GET['edit'];
        $cond = "id = '$AdminId'";
        $SelAdmin = $admins->Select($col,$cond);
        include "admins/editForm.php";
    }else{
        include "admins/table.php";
    }
    
    include "include/footer.php";
?>