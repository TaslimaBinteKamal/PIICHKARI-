<?php
include 'Validation.php';
class Authentication
{
	
    public function signUp($user_id, $name, $password, $email_address, $role_id, $activeStatus, $banStatus)
    {
		$Validation = new Validation();
		$row = $Validation->isEmailExisting($email_address);
		if($row == 0 ){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "INSERT into `user` (user_id, name, email_address, password, role_id, activeStatus, banStatus) 
                  VALUES ('$user_id', '$name','$email_address', '" . md5($password) . "', '$role_id','$activeStatus', '$banStatus')";
        $result = mysqli_query($con, $query);
        return true;
		}
		echo "<script>alert('account can't be created')</script>";
		return false;
    }
	

    public function signIn($email_address,$password)
    {
		$Validation = new Validation();
        $rows = $Validation->checkEmailAndPassword($email_address, $password);
		return $rows;
    }

    public function signOut()
    {
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
}

?>