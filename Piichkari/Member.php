<?php 
include 'User.php';
class Member extends User{

	public function reportUser($username,$profile_name,$profile_email,$reason){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $uid_query = "SELECT user_id FROM `user` WHERE email_address='$profile_email'";
         $uid_result = mysqli_query($con,$uid_query);
         $user_id="";
         if(mysqli_num_rows($uid_result)>0){
         	while($row = mysqli_fetch_array($uid_result)){
         		$user_id = $row['user_id'];
         	}

         }
         $report_id = "rid" .rand(1,1000000);
         $rid_query = "INSERT into `report` (report_id, reported_person, personwho_reported, reason, user_id, email_address,reportActive) 
                 	   VALUES ('$report_id', '$profile_name','$username', '$reason', '$user_id','$profile_email',2)";
         $report_result = mysqli_query($con,$rid_query);
          if ($report_result === TRUE) {
			echo "<script>alert('report table updated')</script>";
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}

	}



	
}



?>