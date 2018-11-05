<?php
include 'db.php';
include 'class/Authentication.php';

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($con,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($con,$_GET['hash']); // Set hash variable
    $authentication = new Authentication();
    $result = $authentication -> getConfirmation($email,$hash);
    if($result){
//        echo '<script>alert ("Your account has been verified।");</script>';
        session_start();
        $_SESSION["email"] = $email;
        header("Location: user.home.php");
    }
}
else{
    // Invalid approach
    echo 'Invalid approach, please use the link that has been send to your email.';
}
?>