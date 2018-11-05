<?php 
class Image{

	public function saveImage($imageTitle,$imageDataURL,$user_id){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
		$image_id = "imgid" .rand(1,100000000);

        $query = "INSERT into `image` (image_id, image_name, image_path, user_id, deleteImage) 
                  VALUES ('$image_id', '$imageTitle','$imageDataURL','$user_id',2)";
        $result = mysqli_query($con, $query);
         if ($result === TRUE) {
			return $result;
		} else {
			echo "<script>alert(\"Error updating record: " . $con->error."\");</script>";
		}
	}

    public function updateImage($imageTitle,$newImageDataURL,$oldImageDataURL, $user_id){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "UPDATE `image` SET image_name = '$imageTitle', image_path = '$newImageDataURL'
                  WHERE image_path = '$oldImageDataURL' AND user_id= '$user_id'";
        $result = mysqli_query($con, $query);
        if ($result === TRUE) {
            return $result;
        } else {
            echo "<script>alert(\"Error updating record: " . $con->error."\");</script>";
        }
    }

    public function getImageInfo($image_path){
        $con = mysqli_connect("localhost", "root", "", "piichkari");
        $sql = "SELECT * FROM image WHERE image_path='$image_path'";
        $record = mysqli_query($con, $sql);
        return $record;
    }

	public function showImage($user_id){
		$con = mysqli_connect("localhost", "root", "") or die(mysqli_error());
		$db = mysqli_select_db($con, 'piichkari') or die(mysqli_error($con));
		$sql = "SELECT * FROM image WHERE user_id='$user_id'";
		$record = mysqli_query($con, $sql);
		return $record;
	 }

	public function deleteImage($imageDataURL){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
         $query = "UPDATE `image` SET deleteImage=1 WHERE image_path = '$imageDataURL'";
		 if ($con->query($query) === TRUE) {
			return true;
		} else {
			echo "<script>alert('Error updating record: " . $con->error."')</script>";
		}
	}

	public function checkImage($imageDataURL){
		$con = mysqli_connect("localhost", "root", "", "piichkari");
        $query = "SELECT deleteImage FROM `image` WHERE image_path = '$imageDataURL' and deleteImage=1";
		$record = mysqli_query($con, $query);
		$row = mysqli_num_rows($record);
		return $row;
	}

    public function countImage($user_id){
        $con = mysqli_connect("localhost", "root", "") or die(mysqli_error());
        $db = mysqli_select_db($con, 'piichkari') or die(mysqli_error($con));
        $sql = "SELECT * FROM image WHERE user_id='$user_id' and deleteImage=2";
        $record = mysqli_query($con, $sql);
        return $record;
    }

}


?>