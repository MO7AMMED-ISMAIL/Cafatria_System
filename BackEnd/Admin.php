<?php
    $current = 'Admins';
    $id = 1 ;
    include "include/sidebar.php";
    include "include/navbar.php";
    include "DataBase/DBCLass.php";
    use DbClass\Table;
    $admins = new Table('admins');
    // $cond = "user_role".'='."'0'";
    // $result = $admins->FindAll($cond);
    // if(isset($_GET['add']) == 'Admin'){
    //     include "Admins/AddForm.php";  
    // }
    // elseif(isset($_GET['edit'])){
    //     $AdminId = $_GET['edit'];
    //     $SelAdmin = $admins->FindById('user_id',$AdminId);
    //     include "Admins/EditForm.php";
    // }else{
    //     include "Admins/table.php";
    // }
    
    include "include/footer.php";
?>