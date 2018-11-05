<?php 
 class User{
	 private $name;
	 private $email_address;
	 private $password;
	 
	 public function setEmail($email_address){
		 $this->email_address = $email_address;
	 }
	 public function getEmail(){
		 return $this->email_address;
	 }
	 
	 public function setName($name){
		 $this->name = $name;
	 }
	
	 public function changeName($password, $changedName, $email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET name='$changedName' WHERE email_address = '$email_address'
                  and password='" . md5($password) . "'";
		 if ($con->query($query) === TRUE) {
			echo "<script>alert('Record updated successfully')</script>";
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
	 }
	 
	  public function changePassword($password, $oldpassword, $email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET password='" . md5($password) . "' WHERE email_address = '$email_address'
                  and password='" . md5($oldpassword) . "'";
		 if ($con->query($query) === TRUE) {
			echo "<script>alert('Record updated successfully')</script>";
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
	 }
	 
	 public function deleteAccount($password, $email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET activeStatus = 2 WHERE email_address = '$email_address'
                  and password='" . md5($password) . "'";
		 if ($con->query($query) === TRUE) {
			echo "<script>alert('You're deactivating')</script>";
			header("Location: logout.php");
		} else {
			echo "<script>alert('Error deleting record: " . $con->error ."')</script>";
		}
	 }
	 
	 public function searchUser($searchq){
		 mysql_connect("localhost","root","piichkari") or die("Could not connect");
		 mysql_select_db("search test") or die("could not find results");
		 $output = '';
		 $query = mysql_query("SELECT * from `user` WHERE name LIKE '%$searchq%' ");
		 $count = mysql_num_rows($query);
	    if($count == 0){
		$output = "There was no results";
		}else{
		while($row = mysql_fetch_array($query)){
			$name = $row['name'];
			$email = $row['email_address'];
			
			$output = '<div>'.$name.' '.$email.'</div>';
		
		}
	}

	 }
	 
 }



?>