<?php
session_start();
require "../../BackEnd/DataBase/DBCLass.php";

use DbClass\Table;

$returnUrl = isset($_GET['return_url']) ? $_GET['return_url'] : 'index.php';

if (isset($_GET['logout'])) {

    session_unset();
    session_destroy();
    header('Location: login.php?return_url=' . urlencode($returnUrl));
    exit();
}


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ' . $returnUrl);
    exit();
}

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
                $_SESSION['logged_in'] = true;
                header('Location: ' . $returnUrl);
                exit();
            } else {
                $_SESSION['message'] = "Incorrect password. Please try again.";
            }
        } else {
            $_SESSION['message'] = "Email not found. Please register or try a different email.";
        }
        $_SESSION['success'] = false;
        header('Location: login.php?return_url=' . urlencode($returnUrl));
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['success'] = false;
        header('Location: login.php?return_url=' . urlencode($returnUrl));
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
    <link href="css/login.css" rel="stylesheet">

    <style>
        button{
            background: #1D4350;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #A43931, #1D4350);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #A43931, #1D4350); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
</head>

<body>
    <div class="container-fluid mainhome">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h1 class="text-light slogan" id="slogan" style="font-style: italic;">Indulge in Digital Delights: Welcome to Caféto Corner</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6 mx-auto">
                <div class="login-container">
                    <h2 class="login-title text-center" style="color:rgb(77, 49, 8); font-style:italic;">Welcome</h2>
                    <?php if (isset($_SESSION['message'])) : ?>
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
                            <a href="forgetPassword.php" class="ForgetPwd text-decoration-none" style="color:blue;">Forget Password?</a>
                        </p>
                        <p class="small mb-5 text-center">
                            <a href="registerform.php" class="ForgetPwd text-decoration-none" style="color:blue;">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="js/log.js"></script>
</body>

</html>