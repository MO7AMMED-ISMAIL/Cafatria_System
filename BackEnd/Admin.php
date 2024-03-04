<?php
    session_start();
    $current = 'Admins';
    $id = 1 ;
    include "include/sidebar.php";
    include "include/navbar.php";
    include "DataBase/DBCLass.php";
    use DbClass\Table;
    $admins = new Table('admins');
    $col = ['id','username','email','profile_picture','created_at'];
    $result = $admins->Select($col);
    
    if(isset($_GET['add']) == 'Admin'){
        include "Admins/AddForm.php";  
    }
    elseif(isset($_GET['edit'])){
        $AdminId = $_GET['edit'];
        $cond = "id = $AdminId";
        $SelAdmin = $admins->Select($col,$cond);
        $SelAdmin = $SelAdmin[0];
        include "Admins/EditForm.php";
    }else{
        include "Admins/table.php";
    }
    
    include "include/footer.php";
?>