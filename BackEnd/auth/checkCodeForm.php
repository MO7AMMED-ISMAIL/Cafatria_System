<?php
    session_start();
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600;
?>
<head>
    <title>ASPS Login</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-password-image {
            background-image: url('https://cdn.pixabay.com/photo/2023/10/20/19/24/path-8330103_640.jpg');
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Code Verification</h1>
                                    </div>
                                    <p>We have send a verification code in your email . 
                                    Please , Enter this code here</p>
                                    
                                    <!--form -->
                                    <form class="user" method="post" action="CodeVerification.php">
                                        <!-- token -->
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" value="<?=$_SESSION['token']?>" name="token" id="token">
                                        </div>

                                        <!-- Code -->
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="code" required placeholder="Enter Verification Code ..." id="text" require>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Verify
                                        </button>
                                        <?php
                                            if(isset($_SESSION['checkCode'])){
                                        ?>
                                            <div class="alert alert-danger">
                                                <span class="text-center d-block">
                                                    <?php
                                                        echo $_SESSION['checkCode'];
                                                        unset($_SESSION['checkCode']);
                                                    ?>
                                                </span>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                        <hr>
                                    </form>
                                    <!-- End form -->
                                    <div class="text-center">
                                        <a class="small" href="loginForm.php">Already have an account? Login!</a>
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
