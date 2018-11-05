<?php 
include ("db.php");
$email_address="";
$userName="";
$user_id="";
if(isset($_SESSION["email"])){$email_address = $_SESSION["email"];

$query = "SELECT * from `user` WHERE email_address = '$email_address'";
$result = mysqli_query($con, $query);

if($result === FALSE) { 
	echo mysql_error();
	echo "no data retieved";
	}
while($record = mysqli_fetch_array($result)){
	$role_id = $record['role_id'];
	$userName = $record['name'];
	$user_id=$record['user_id'];
}
}

?>