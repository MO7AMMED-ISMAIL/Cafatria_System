

<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "cafeteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_GET['id'])) {
    $order_id =$_GET['id'];

    $sql = "DELETE FROM orders WHERE id = $order_id";
    if ($conn->query($sql) === TRUE) {
        echo "Order canceled successfully";
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
