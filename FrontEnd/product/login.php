<?php
session_start();
require "class.php";

use DbClass\Table;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $usersTable = new Table('users');
        $statement = $usersTable->Select(['id', 'password'], 'email = "' . $email . '"');

        if (!empty($statement)) {
            $userData = $statement->fetch(PDO::FETCH_ASSOC);
            if ($password == $userData['password']) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['message'] = "Login successful.";
                $_SESSION['success'] = true;
                header('Location: index.php');
                exit();
            } else {
                $_SESSION['message'] = "Incorrect password. Please try again.";
            }
        } else {
            $_SESSION['message'] = "Email not found. Please register or try a different email.";
        }
        $_SESSION['success'] = false;
        header('Location: login.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['success'] = false;
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    
    <style>
        body {
            background-image: url("images/s14.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .login-container {
            background-color: rgba(241, 250, 249, 0.547);
            max-width: 78%;
            height: 78%;
            margin: auto;
            margin-top: 11%;
            padding: 10%;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            color: rgb(55, 122, 223);
        }
        .form-control {
            background-color: transparent; 
            border: none; 
            border-bottom: 2px solid #5A2A00; 
            border-radius: 0; 
            color: rgb(55, 122, 223); 
            margin-bottom: 1rem; 
        }
        
        .form-control:focus {
            box-shadow: none; 
            border-color:rgb(55, 122, 223); 
            
        }
       
        .form-floating label {
            color: #5A2A00; 
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-6 mx-auto">
                <div class="login-container">
                    <h2 class="login-title text-center" style="color:rgb(77, 49, 8); font-style:italic;">Welcome To Cafeto</h2>
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-floating mb-3 my-5">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating my-5">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mb-3 text-center my-5">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <p class="small mb-5 text-center my-5">
                            <a href="forgetPassword.php" class="ForgetPwd" style="color:blue;">Forget Password?</a>
                        </p>

                        <p class="small mb-5 text-center">
                            <a href="isreg.php" class="ForgetPwd" style="color:blue;">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

