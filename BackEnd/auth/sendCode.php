
<?php
session_start();
include "../DataBase/DBCLass.php";
use DbClass\Table;
$admins = new Table('admins');

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(!isset($_POST['token']) || !isset($_SESSION['token'])){
        exit('Token is not set');
        include "../404.html";
    }

    if($_POST['token'] == $_SESSION['token']){
        if(time() >= $_SESSION['token_expire']){
            exit('Token expired');
            include "../404.html";
        }
        unset($_SESSION['token']);
    }

    

    try{
        $email = $_POST['email'];
        $col = ['email'];
        $cond = "email = '$email'";
        $result = $admins->Select($col,$cond);
        $result = $result->fetch(\PDO::FETCH_ASSOC);
        if(count($result) == 0){
            throw new Exception("The Email is not found");
        }
        $code = mt_rand(100000, 999999);
        $_SESSION['code'] = $code;
        $subject = 'Verification Code';
        $message = "
            <html>
                <body>
                    <style>
                        a{
                            width: 300px;
                            height: 300px;
                            background-color: gray;
                            color: black;
                        }
                    </style>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-md-6 offset-md-3'>
                                <h2 class='text-center'>Verification code is $code</h2>
                                <a href='http://localhost/PHP_44/PHP_Project_ITI/BackEnd/Auth/sendCode.php'>go to...</a>
                            </div>
                        </div>
                    </div>
                </body>
            </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: mo7mmedismail200@gmail.com';
        
        if(mail($email, $subject, $message, $headers)){
            $_SESSION['code'] = $code;
            $_SESSION['email'] = $email;
            header("Location: ./checkCodeForm.php");
        }else{
            $_SESSION['email_verfiy'] =  "You have a Proplem in network Connection established";
            header("Location: ./forgotPassword.php");
        }

    }catch(Exception $e){
        $_SESSION['email_verfiy'] =  "This Email is not Found";
        header("Location: ./forgotPassword.php");
        exit();
    }
}

?>