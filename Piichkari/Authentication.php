<?php
include 'Validation.php';
class Authentication
{
	
    public function signUp($user_id, $name, $password, $email_address, $role_id, $activeStatus, $banStatus, $hash, $verifiedStatus){
		$Validation = new Validation();
		$row = $Validation->isEmailExisting($email_address);
		if($row == 0 ) {
            $con = mysqli_connect("localhost", "root", "", "piichkari");
            $query = "INSERT into `user` (user_id, name, email_address, password, role_id, activeStatus, banStatus, hash, verifiedStatus) 
                  VALUES ('$user_id', '$name','$email_address', '" . md5($password) . "', '$role_id','$activeStatus', '$banStatus',
                  '$hash', '$verifiedStatus')";
            $result = mysqli_query($con, $query);
            return $result;
        }
		else return false;
    }

    public function  getConfirmation($email,$hash){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT email_address, hash, verifiedStatus FROM `user` WHERE email_address='$email' AND hash='$hash' AND verifiedStatus= 0";
        $result = mysqli_query($con,$query);
        if ($result) {
            $query2 = "UPDATE `user` SET verifiedStatus= 1 WHERE email_address='$email' AND hash='$hash' AND verifiedStatus= 0";
            $result2 = mysqli_query($con,$query2);
            return $result2;
        }
        else{
            // No match -> invalid url or account has already been activated.
            echo '<script>alert("Invalid link or Your account has already been verified")</script>';
        }
    }

    public function signIn($email_address,$password){
		$Validation = new Validation();
        $rows = $Validation->checkEmailAndPassword($email_address, $password);
		return $rows;
    }

    public function signOut(){
        session_start();
        if (session_destroy()) {
            header("Location: index.php");
        }
    }
	
	public function activeAccount($email_address){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "UPDATE `user` SET activeStatus = 1 WHERE email_address = '$email_address'";
        $result = mysqli_query($con, $query) or die(mysql_error());
				 if ($con->query($query) === TRUE) {
			echo "<script>alert('Welcome Back')</script>";
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
	}

	public function getPasswordRecoveryLink($email_address){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT hash from `user` where email_address = '$email_address'";
        $result = $con->query($query);
        return $result;
    }

    public function getUserInfoForResetPassword($email_address, $hash){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT email_address, hash, activeStatus FROM `user` WHERE email_address='$email_address' AND hash='$hash' AND activeStatus= 1";
        $result = $con->query($query);
        return $result;
    }

    public function resetPassword($email_address, $password){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "UPDATE `user` SET password='" . md5($password) . "' WHERE email_address = '$email_address'";
        $result = $con->query($query);
        return $result;
    }
}
?>