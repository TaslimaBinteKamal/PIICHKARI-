<?php


if (isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
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
?>