<?php
session_start();

if(isset($_GET['reset'])){
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600;
}else{
    header("Location: ../404.php");
    exit();
}
?>

<head>
    <title>Resest Password</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <!--form -->
                                    <form class="user" method="post" action="UpdatePassword.php">
                                        
                                        <!-- token -->
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" value="<?=$_SESSION['token']?>" name="token" id="token">
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" required placeholder="New Password" id="text" name="password" require>
                                        </div>
                                        <!-- Repeat Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" required placeholder="Repeat New Password" id="text" name="repeatPassword" require>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Verify
                                        </button>
                                        <hr>
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
                                    <!-- End form -->
                                    <div class="text-center">
                                        <a class="small" href="LoginForm.php">Already have an account? Login!</a>
                                    </div>

                                    <div class="text-center">
                                        <a class="small" href="registerForm.php">Create a new account!</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

