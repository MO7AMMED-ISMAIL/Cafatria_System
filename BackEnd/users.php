<?php
// Start the session
session_start();
$current ='User';
$id = 1 ;


include "include/sidebar.php";
include "include/navbar.php";


include "DataBase/DBCLass.php";
use DbClass\Table;


$table = new Table('users');
try {
        $users = $table->Select(['id', 'username', 'room_number', 'profile_picture', 'extra_data']);
    } catch (Exception $e) {
        // Handle exceptions if any
        $users=[];
        
    }

// Handle different actions based on GET parameters
if (isset($_GET['add'] )== 'User') {
    include "users/addform.php";
} elseif(isset($_GET['edit'])){
    $userId = $_GET['edit'];
    $cond = "id = '$userId'";
    $result = $table->Select(['id', 'username','email' ,'room_number', 'profile_picture', 'extra_data'],$cond);
    //var_dump($result);
    
    include "users/edit.php";
} 
else {
    
     include "users/users_table.php";
}

// Include the footer
include "include/footer.php";
?>
