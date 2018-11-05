<?php 
require('db.php');
include("auth.php");
include 'class/Authentication.php';
if(isset($_POST['activateAccountBtn']))
{
	$Authentication = new Authentication();
	$email_address=$_SESSION["email"];
	$Authentication->activeAccount($email_address);
	header("Location: user.home.php");

}
if(isset($_POST['activateAccountBtn2']))
{
	header("Location: index.php");

}

?>



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
            <div class="center col-sm-6 col-sm-offset-5 form-box">
                <div class="form-bottom">
                    <div class="form-bottom-left" style="color: white">
                        <p class="text-center">Do you want to activate your account?</p>
                    </div>
                    <form role="form" action="" method="post" class="login-form text-center">
                        <input type="hidden" name="email">
                        <div class="btn-group">
                            <button name="activateAccountBtn" type="submit" class="btn">Yes</button>
                            <button name="activateAccountBtn2" type="submit" class="btn" style="margin-left: 10px">No</button>
                        </div>
                    </form>
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


<!-- Custom scripts for this template -->

</body>
</html>