<?php 
class CommentPost{

	public function storeComment($user_id,$image_id,$remark){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
		$cmid = "cmid" .rand(1,10000000000);
        $query =  "INSERT into `comment` (comment_id, user_id,remark) 
                  VALUES ('$cmid', '$user_id','$remark')";
		$result = mysqli_query($con, $query);
		$sql_query =  "INSERT into `commentonimage` (comment_id,image_id) 
                  VALUES ('$cmid', '$image_id')";
		$img_com_record = mysqli_query($con, $sql_query);

	}

	public function showCommentID($image_id){
		$con = mysqli_connect("localhost", "root", "") or die(mysqli_error());
        $db = mysqli_select_db($con, 'piichkari') or die(mysqli_error($con));
        $query = "SELECT * FROM `commentonimage` WHERE image_id='$image_id'";
        $result = mysqli_query($con, $query);
        return $result;
	}

	public function getCommentInfo($comment_id){
		$con = mysqli_connect("localhost", "root", "") or die(mysqli_error());
        $db = mysqli_select_db($con, 'piichkari') or die(mysqli_error($con));
        $query = "SELECT * FROM`comment` WHERE comment_id='$comment_id'";
        $result = mysqli_query($con, $query);
        return $result;

	}
	public function showCommenters($user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT name FROM `user` WHERE user_id = '$user_id'";
		$record = mysqli_query($con, $query);
		$comname="";
		while($commenter=mysqli_fetch_array($record)){
         	$comname = $commenter['name'];
        }
		return $comname;
	}

}
?>