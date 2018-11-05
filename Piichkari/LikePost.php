<?php 
class LikePost{

	public function likeImage($imageID,$user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query =  "INSERT into `givelike` (image_id, user_id) 
                  VALUES ('$imageID', '$user_id')";
		$result = mysqli_query($con, $query);
       /* if ($result === TRUE) {
			//echo "<script>alert(\"You Liked the image\");</script>";
			$sql = "UPDATE `image` SET likeCount=likeCount+1 WHERE image_id='$imageID' ";
			if ($con->query($sql) === TRUE) {
			//echo "<script>alert('likeCount increased')</script>";
		} else {
			//echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
		} else {
			//echo "<script>alert(\"Error updating record: " . $con->error."\");</script>";
		}*/
	}

	public function checkLike($imageID,$user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT * FROM `givelike` WHERE image_id = '$imageID' and user_id='$user_id'";
		$record = mysqli_query($con, $query);
		$row = mysqli_num_rows($record);
		return $row;
	}

	public function unlikeImage($imageID,$user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query =  "DELETE FROM givelike WHERE image_id='$imageID' and user_id='$user_id'";
		$result = mysqli_query($con, $query);
        /*if ($result === TRUE) {
			//echo "<script>alert(\"You Unliked the image\");</script>";
			$sql = "UPDATE `image` SET likeCount=likeCount-1 WHERE image_id='$imageID' ";
			if ($con->query($sql) === TRUE) {
			//echo "<script>alert('likeCount decreased')</script>";
		} else {
			//echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
		} else {
			//echo "<script>alert(\"Error updating record: " . $con->error."\");</script>";
		}*/
	}

	/*public function checkLikeCount($imageID){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT * FROM `givelike` WHERE image_id = '$imageID'";
		$record = mysqli_query($con, $query);
        $row = mysqli_num_rows($record);
		return $row;
	}*/

	public function fetchUser($imageID){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT * FROM `givelike` WHERE image_id = '$imageID'";
		$record = mysqli_query($con, $query);
		return $record;
	}

	public function showUsers($user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT name FROM `user` WHERE user_id = '$user_id'";
		$record = mysqli_query($con, $query);
		return $record;
	}

}

?>