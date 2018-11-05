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
                        <h3>Sign up in <a href="index.html">Piichkari</a></h3>
                        <p>Enter Email address and Password to Register:</p>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="" name="register" method="post" class="login-form" onSubmit="return checkPasswordSignUp();">
                        <div class="form-group">
                            <label class="sr-only" for="form-username">Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-username form-control" id="form-name">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-username">Email Address</label>
                            <input type="text" name="email" placeholder="Email" class="form-username form-control" id="form-username">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input type="password" name="password1" placeholder="Password" class="form-password form-control" id="form-password">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Confirm Password</label>
                            <input type="password" name="password2" placeholder="Confirm Password" class="form-password form-control" id="form-repassword">
                        </div>
                        <button type="submit" name= "register" class="btn">Sign up!</button>
                    </form>
                    <div class="form-bottom-left">
                        <p>Already registered? <a href="signin.php">Sign In!</a></p>
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
<script type="text/javascript">
    function CheckPassword(password1,password2){
    
    var password1Len = password1.value.length;
    var password2Len = password2.value.length;
    if (password1Len < 8 || password1Len > 16)
    {
         swal("Error","Password should not be empty / length be minimum 8 characters and maximum 16 characters","error");
        password1.focus();
        return false;
    }
    if (password2.value != password1.value)
    {
         swal("Error","password doesn't match","error");
        password2.focus();
        return false;
    }
    return true; 
}
    function checkPasswordSignUp(){
        var password1 = document.register.password1;
        var password2 = document.register.password2;
        if(CheckPassword(password1,password2)){
            return true;
        }
        return false;
    }
</script>


<?php
require('db.php');
include 'class/Authentication.php';
include  'emailConfiguration.php';
if (isset($_REQUEST['name'])) {
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($con, $name);
    $email_address = stripslashes($_REQUEST['email']);
    $email_address = mysqli_real_escape_string($con, $email_address);
    $password = stripslashes($_REQUEST['password2']);
    $password = mysqli_real_escape_string($con, $password);
    $Authentication = new Authentication();
    $user_id = "uid" .rand(1,1000000);
    $role_id=2;
    $activeStatus=1;
    $banStatus=2;
    $hash = md5( rand(0,1000) );
    $verifiedStatus = 0;
    $message = "
		Welcome to Piichari!<br/>
	    Your account has been created, you have to click the following link to activate your account <br/>	 
		Email: $email_address <br/> 
		Click on the link:
		http://$domainIP/verify.php?email=$email_address&hash=$hash";
    $result = $Authentication->signUp($user_id, $name, $password, $email_address, $role_id ,$activeStatus, $banStatus, $hash, $verifiedStatus);
    if ($result) {
        require_once 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $mailUsername;
        $mail->Password = $mailPassword;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($mailUsername, 'Piichkari');
        $mail->addAddress($email_address);
        $mail->addReplyTo($mailUsername, 'Piichkari');
        $mail->isHTML(true);
        $mail->Subject = "Piichkari Registration" ;
        $mail->Body    = $message;
        if(!$mail->send()) {
            echo "<script>alert(\"Email cant be sent. $mail->ErrorInfo;\");</script>";
        }
        else {
            echo "<script>alert(\"Email verification link has been sent to your email\");
                    window.location = 'index.php';
                  </script>";
        }
    }
    else echo "<script>swal(\"Error!\", \"Email already exists!\", \"error\");</script>";
}
?>