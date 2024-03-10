<?php
// Include the DBClass file
include "../DataBase/DBCLass.php";

use DbClass\Table;

// Check if 'id' key is set in the $_GET array and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        
        $table = new Table('users');

        
        $result = $table->Select(['id', 'username', 'email', 'password', 'room_number', 'extra_data', 'profile_picture', 'created_at'], "id = $id");

        
        if (!$result) {
            throw new Exception("User not found.");
        }
    } catch (Exception $e) {
        
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    
    echo "Error: User ID is not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
        .container {
            padding-top: 50px; /* Add padding to the top of the container */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                User Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> <?= $result['id']; ?></p>
                        <p><strong>Username:</strong> <?= $result['username']; ?></p>
                        <p><strong>Email:</strong> <?= $result['email']; ?></p>
                        <p><strong>Password:</strong> <?= $result['password']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Room Number:</strong> <?= $result['room_number']; ?></p>
                        <p><strong>Extra Data:</strong> <?= $result['extra_data']; ?></p>
                        <p><strong>Profile Picture:</strong> <?= $result['profile_picture']; ?></p>
                        <p><strong>Created At:</strong> <?= $result['created_at']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
