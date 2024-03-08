<?php
    session_start();
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600;

    if(isset($_SESSION['id'])){
        header("location: ../index.php");
        exit();
    }
?>
<head>
    <title>Admin</title>
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary mt-5 pt-2">

    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-4">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="./login.php" method="post">
                                        <!-- token -->
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" value="<?=$_SESSION['token']?>" name="token" id="token">
                                        </div>

                                        <!-- email -->
                                        <div class="input-group mb-3 ">
                                            <span class="input-group-text" id="basic-addon1">email</span>
                                            <input type="text" class="form-control" placeholder="Email...." name="email">
                                        </div>

                                        <!-- password -->
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Password</span>
                                            <input type="password" class="form-control" placeholder="Password...." name="pass">
                                        </div>

                                        <!-- Rember Me -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>

                                        <?php
                                            if(isset($_SESSION['err'])){
                                        ?>
                                            <div class="alert alert-danger mt-3">
                                                <?php 
                                                    echo $_SESSION['err'];
                                                    unset($_SESSION['err']);
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </form>
                                    <hr>

                                    <!-- Forget Password -->
                                    <div class="text-center">
                                        <a class="small" href="./forgotPassword.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="./registerForm.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

