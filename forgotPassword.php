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
                        <p>Enter email to get reset password link:</p>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="" method="post" class="login-form">
                        <div class="form-group">
                            <label class="sr-only" for="form-username">Email Adress</label>
                            <input type="text" name="email" placeholder="Email" class="form-username form-control"
                                   id="form-username" required>
                        </div>
                        <button name="forgotPassword" type="submit" class="btn">Send Link!</button>
                    </form>
                    <div class="form-bottom-left">
                        <p>Want to go back? <a href="signin.php">Click here!</a></p>
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
include 'emailConfiguration.php';
if (isset($_REQUEST['email'])) {
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $authentication = new Authentication();
    $result = $authentication->getPasswordRecoveryLink($email);
    $row = mysqli_num_rows($result);
    if ($row==1){
        while($record = mysqli_fetch_array($result)){
            $hash = $record["hash"];
        }
        $message = "Your password reset link: http://$domainIP/passwordReset.php?email=$email&hash=$hash";
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
        $mail->addAddress($email);
        $mail->addReplyTo($mailUsername, 'Piichkari');
        $mail->isHTML(true);
        $mail->Subject = "Piichkari Reset Password" ;
        $mail->Body    = $message;
        if(!$mail->send()) {
            echo "<script>alert(\"Email cant be sent. $mail->ErrorInfo;\");</script>";
        }
        else {
            echo "<script>alert(\"Reset Password link has been sent to your email\");
                    window.location = 'index.php';
                  </script>";
        }
    }
    else {
        echo "<script>swal(\"Error!\", \"This email is not registered!\", \"error\");</script>";
    }

}

?>