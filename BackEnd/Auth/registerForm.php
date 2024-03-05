<title>Register</title>
<link href="../css/sb-admin-2.min.css" rel="stylesheet">


<body class="bg-gradient-primary p-5">

<div class="container mt-5">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user">
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
                                    <span class="input-group-text" id="basic-addon1">image</span>
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
                                        <span class="input-group-text" id="basic-addon1">email</span>
                                        <input type="password" class="form-control" placeholder="repeat Password..." name="rep-pass">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="loginForm.php" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a>
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


