<?php
include 'User.php';
class Admin extends User{
	public function banUser($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET banStatus=1 WHERE email_address = '$email_address'";
		 if ($con->query($query) === TRUE) {
			echo "<script>alert('user got banned')</script>";
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
	 }
	 public function checkUser($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "SELECT * FROM `report` WHERE email_address='$email_address'";
		 $result = mysqli_query($con, $query) or die(mysql_error());
		 $row = mysqli_num_rows($result);
		 return $row;
	 }
	



}




?>