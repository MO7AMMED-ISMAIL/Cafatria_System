<?php

include "../header.php";
include "../../DataBase/DBClass.php";
use DbClass\Table;
$users = new Table('admins');

$output = [
    "flag"=> 0,
    "data"=> '',
    "meg"=> ''
];

$allData = $users->Select(['username', 'password','email','created_at']);

print_r($allData);
// json_encode($allData);
?>