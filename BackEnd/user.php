<?php
    session_start();
    $current = 'Users';
    $id = 1 ;
    include "include/sidebar.php";
    include "include/navbar.php";
    include "DataBase/DBCLass.php";
    use DbClass\Table;
    $users = new Table('users');

    $col = [
        'id',
        'username',
        'email',
        'profile_picture',
        'created_at',
        'room_number',
        'extra_Number'
    ];
    $result = $users->Select($col);
    
    if(isset($_GET['add']) == 'Users'){
        include "Users/AddForm.php";  
    }
    elseif(isset($_GET['edit'])){
        $userId = $_GET['edit'];
        $cond = "id = $userId";
        $SelUser = $users->Select($col,$cond);
        $SelUser = $SelUser[0];
        include "Users/EditForm.php";
    }else{
        include "Users/table.php";
    }
    
    include "include/footer.php";
?>