<?php

class Validation
{
    public function checkEmailAndPassword($email_address, $password)
    {
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT * FROM `user` WHERE email_address='$email_address'
                  and password='" . md5($password) . "' and verifiedStatus=1";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $row = mysqli_num_rows($result);
        return $row;
    }

	public function checkRole($email_address, $password){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT role_id FROM `user` WHERE email_address='$email_address'
                  and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$role_id=0;
		while($fieldinfo=mysqli_fetch_object($result)){
			$role_id = $fieldinfo->role_id;
		}
		return $role_id;
	
	}
	
		
	public function checkActiveStatus($email_address, $password){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT activeStatus FROM `user` WHERE email_address='$email_address'
                  and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$activeStatus=0;
		while($fieldinfo=mysqli_fetch_object($result)){
			$activeStatus = $fieldinfo->activeStatus;
		}
		return $activeStatus;
	
	}
	
	public function checkBanStatus($email_address, $password){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT banStatus FROM `user` WHERE email_address='$email_address'
                  and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$banStatus=0;
		while($fieldinfo=mysqli_fetch_object($result)){
			$banStatus = $fieldinfo->banStatus;
		}
		return $banStatus;
	
	}
	
	
	
	public function isEmailExisting($email_address){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT * FROM `user` WHERE email_address='$email_address'";
		$result = mysqli_query($con, $query) or die(mysql_error());
        $row = mysqli_num_rows($result);
		return $row;
	}
    
   
}

?>