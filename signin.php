
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Piichkari</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="vendor/fonts/sans.css">
    <link rel="stylesheet" href="vendor/fonts/merriweather.css">
    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form-elements.css">
    <!-- Custom styles for this template -->
    <link href="css/creative.css" rel="stylesheet">
    <link rel="stylesheet" href="css/authentication.css">


</head>
<body>
<!-- Top content -->
<div class="top-content">
    <div class="container">
        <div class="row">
            <div class="center col-sm-6 col-sm-offset-3 form-box ">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Welcome to <a href="index.php">Piichkari</a></h3>
                        <p>Need an Account? <a href="signup.php">Sign Up Now!</a></p>
                        <p>Enter Email address and Password to log in:</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="" method="post" class="login-form">
                        <div class="form-group">
                            <label class="sr-only" for="form-username">Email Adress</label>
                            <input type="text" name="email" placeholder="Email" class="form-username form-control" id="form-username" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-password form-control" id="form-password" required>
                        </div>
                        <button name="signIn" type="submit" class="btn">Sign in!</button>
                    </form>
                    <div class="form-bottom-left">
                        <p>Forgot Password? <a href="forgotPassword.php">Click here!</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery/jquery.backstretch.min.js"></script>
<script src="js/authentication.js"></script>
<script src="js/sweetalert.min.js"></script>

<!-- Custom scripts for this template -->

</body>
</html>
<?php
require('db.php');
include 'class/Authentication.php';
include 'class/User.php';
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['email'])) {
    // removes backslashes
    $email_address = stripslashes($_REQUEST['email']);
    //escapes special characters in a string
    $email_address = mysqli_real_escape_string($con, $email_address);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    //Checking is user existing in the database or not
    $Authentication = new Authentication();
    $validation = new Validation();
    $rows = $Authentication->signIn($email_address, $password);
    $role_id = $validation->checkRole($email_address, $password);
    $activeStatus = $validation->checkActiveStatus($email_address, $password);
    $banStatus = $validation->checkBanStatus($email_address, $password);
    if ($rows == 1) {
        $_SESSION["email"] = $email_address;
        // Redirect user to index.php
        $user = new User();
        if ($banStatus == 1){
                $something= '<script>swal("Oh no!", "YOU ARE BANNED!", "error");</script>';
               echo $something;
        }
        
        else if($banStatus == 2 && $activeStatus==1)
        {
            if($role_id == '2')
            {
            header("Location: user.home.php");
            }
            if($role_id == '1')
            {
            header("Location: admin.home.php");
            }
        }
        
        else if ($activeStatus == 2){

            header("Location: activateAccount.php");
        }
    } else 
        
        echo "<script>swal(\"Error!\", \"Wrong credentials or your account has not been verified yet!\", \"error\");</script>";
    
} 
    ?>
