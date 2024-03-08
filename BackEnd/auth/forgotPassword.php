<?php
    session_start();
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600 ;
?>
<title>Send Mail</title>
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<body class="bg-gradient-primary p-5">

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" action="./sendCode.php" method="post">
                                        <!-- token -->
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" value="<?=$_SESSION['token']?>" name="token" id="token">
                                        </div>

                                        <!-- email -->
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Verify Email
                                        </button>
                                    </form>
                                    <hr>

                                    <?php
                                        if(isset($_SESSION['email_verfiy'])){
                                    ?>
                                        <div class="alert alert-danger">
                                            <span class="text-center d-block">
                                                <?php
                                                    echo $_SESSION['email_verfiy'];
                                                    unset($_SESSION['email_verfiy']);
                                                ?>
                                            </span>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="text-center">
                                        <a class="small" href="./loginForm.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>