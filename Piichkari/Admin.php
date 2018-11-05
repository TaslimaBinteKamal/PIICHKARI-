<?php
include 'User.php';
class Admin extends User{
	public function banUser($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET banStatus=1 WHERE email_address = '$email_address'";
		 if ($con->query($query) === TRUE) {
		 	return true;
			//echo "<script>alert('user got banned')</script>";
		} else {
			echo "<script>alert('Cannot be banned')</script>";
		}
	 }
	 public function checkUser($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "SELECT * FROM `report` WHERE email_address='$email_address'";
		 $result = mysqli_query($con, $query) or die(mysql_error());
		 $row = mysqli_num_rows($result);
		 return $row;
	 }
	 public function isBanned($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "SELECT banStatus FROM `user` WHERE email_address='$email_address' and banStatus=1";
		 $result = mysqli_query($con, $query) or die(mysql_error());
		 $row = mysqli_num_rows($result);
		 return $row;
	 }
	 public function unbanUser($email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET banStatus=2 WHERE email_address = '$email_address'";
		 if ($con->query($query) === TRUE) {
		 	return true;
			//echo "<script>alert('user got unbanned')</script>";
		} else {
			echo "<script>alert('Cannot be unbanned')</script>";
		}
	 }
	  public function discard($email_address,$report_id){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
		
         $query = "UPDATE `report` SET reportActive=1 WHERE email_address = '$email_address' and report_id = '$report_id'";
		 if ($con->query($query) === TRUE) {
			return true;
		} else {
			echo "<script>alert('Cannot Discard')</script>";
		}
	 }
	 public function checkReportStatus($email_address,$report_id){
	 	 $con = mysqli_connect("localhost", "root", "", "piichkari");
		
         $query = "SELECT reportActive FROM `report` WHERE email_address = '$email_address' and report_id = '$report_id'";
          $result = mysqli_query($con, $query) or die(mysql_error());
         $reportActive=0;
		while($fieldinfo=mysqli_fetch_object($result)){
			$reportActive = $fieldinfo->reportActive;
		}
		return $reportActive;
		 
	 }


}




?>