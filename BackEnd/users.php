<?php
// Start the session
session_start();
$current ='User';
$id = 1 ;

include "DataBase/DBCLass.php";
use DbClass\Table;
$table = new Table('users');
$room = new Table('rooms');
include "include/sidebar.php";
include "include/navbar.php";

try {
    $users = $table->Select(['*']);
    $rooms = $room->Select(['*']);
    
} catch (Exception $e) {
    $users=[];
}

// Handle different actions based on GET parameters
if (isset($_GET['add'] )) {
    
    include "users/addform.php";
} elseif(isset($_GET['edit'])){
    $userId = $_GET['edit'];
    $result = $table->FindById('id',$userId);
    include "users/edit.php";
}else {
    include "users/users_table.php";
}

include "include/footer.php";
?>
