<?php
    session_start();
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600 ;
?>

<title>Register</title>
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<body class="bg-gradient-primary p-5">

<div class="container mt-5">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <?php
                            if(isset($_SESSION['sucess_reg'])){
                        ?>
                            <div class="alert alert-success">
                                <h4 class="text-gray-900 mb-4">
                                    <?php
                                        echo $_SESSION['sucess_reg'];
                                        unset($_SESSION['sucess_reg']);
                                    ?>
                                </h4>
                            </div>
                        <?php }?>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                            <!-- Tokens -->
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-user" name="token" value="<?=$_SESSION['token']?>">
                            </div>

                            <div class="form-group row">
                                <!-- username -->
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">username</span>
                                        <input type="text" class="form-control" placeholder="Username..." name="username">
                                    </div>
                                </div>

                                <!-- email -->
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">email</span>
                                        <input type="email" class="form-control" placeholder="Email..." name="email">
                                    </div>
                                </div>
                            </div>

                            <!-- image -->
                            <div class="input-group mb-3">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="img">
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- password -->
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Password</span>
                                        <input type="password" class="form-control" placeholder="Password..." name="pass">
                                    </div>
                                </div>

                                <!-- repeat Pass -->
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">repeat Pass</span>
                                        <input type="password" class="form-control" placeholder="repeat Password..." name="rep_pass">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
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
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="loginForm.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


