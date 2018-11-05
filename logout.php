<?php
include 'class/Authentication.php';
echo $_SESSION["email"];
$Authentication = new Authentication();
$Authentication->signOut();
?>