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
			return TRUE;
		} else {
			return FALSE;
		}
	 }
	 
	  public function changePassword($password, $oldpassword, $email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET password='" . md5($password) . "' WHERE email_address = '$email_address'
                  and password='" . md5($oldpassword) . "'";
		 if ($con->query($query) === TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	 }
	 
	 public function deleteAccount($password, $email_address){
		 $con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `user` SET activeStatus = 2 WHERE email_address = '$email_address'
                  and password='" . md5($password) . "'";

         if ($con->query($query) === TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
		 
	 }
	 public function checkOldpassword($password,$user_id){
	 	 $con = mysqli_connect("localhost", "root", "", "piichkari");
		 //$output = '';
		 $query = "SELECT * FROM `user` WHERE user_id = '$user_id' and password= '" . md5($password) . "'";
		 $results = mysqli_query($con, $query);
		 if (mysqli_num_rows($results)==1) {
		 	return TRUE;
			
		} 
		else{
			
			return FALSE;
		}
	 }
	 
	 public function searchUser($searchq){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
		 //$output = '';
		 $query = "SELECT * FROM `user` WHERE name LIKE '%$searchq%' ";
		 $results = mysqli_query($con, $query);
		 $count = mysqli_num_rows($results);
		 
		 return $results;
	   
	 }
	 
	 
 }



?>