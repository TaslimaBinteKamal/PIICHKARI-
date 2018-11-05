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
    <script src="js/PasswordCheck.js"></script>
</head>
<body>
<!-- Top content -->
<div class="top-content">
    <div class="container">
        <div class="row">
            <div class="center col-sm-6 col-sm-offset-3 form-box ">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Reset Password</h3>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="" name="register" method="post" class="login-form" onSubmit="return checkPasswordSignUp();">
                        <div class="form-group">
                            <label class="sr-only" for="form-password">New Password</label>
                            <input type="password" name="password1" placeholder="Password" class="form-password form-control" id="form-password">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Confirm Password</label>
                            <input type="password" name="password2" placeholder="Confirm Password" class="form-password form-control" id="form-repassword">
                        </div>
                        <button type="submit" name= "resetPassword" class="btn">Reset</button>
                    </form>
                    <div class="form-bottom-left">
                        <p>Want to sign in? <a href="signin.php">Sign In!</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/jquery/jquery.backstretch.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/authentication.js"></script>
<script src="js/sweetalert.min.js"></script>

<!-- Custom scripts for this template -->

</body>
</html>

<?php
require('db.php');
include 'class/Authentication.php';

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($con,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($con,$_GET['hash']); // Set hash variable

    $authentication = new Authentication();
    $resultGetInfo = $authentication->getUserInfoForResetPassword($email,$hash);
    if($resultGetInfo){
        if (isset($_POST['password1'])){
            $newPassword = $_POST['password1'];
            $resultResetPass = $authentication->resetPassword($email, $newPassword);
            if ($resultResetPass){
                echo '<script>
                        swal("Updated.", "Your password has been reset. You can log in with new password", "info")
                            .then((value) => {
                            window.location.href = "signin.php";
                        });
                    </script>';
            }
            else echo '<script>alert ("Something went wrong");</script>';
        }
    }
    else echo 'Link is invalid';
}
else{
    // Invalid approach
    echo 'This link is invalid or you are not registered';
}


?>