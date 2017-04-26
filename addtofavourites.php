<?php 
	session_start();
	include ('php/connection.inc');
	
	//$fName=$_REQUEST['fName'];
	$fId=$_REQUEST['fId'];
	$userId=$conn->real_escape_string($_SESSION['user_id']);
	$querycheckifexists="SELECT * FROM favourites WHERE ( userId ='$userId' AND pokId = '$fId' )";
	$checkiffavexists = $conn->query($querycheckifexists);
	if($checkiffavexists->num_rows==0){
		$queryfav = "INSERT INTO favourites VALUES (null, '$userId', '$fId')";
		if ($conn->query($queryfav)) {
			echo "success";
		}
		
		else{
			echo $conn->error;
		}
	}
	else {
		echo "exists";
	}

	
?>