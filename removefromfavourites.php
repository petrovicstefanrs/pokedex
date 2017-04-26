<?php 
	session_start();
	include ('php/connection.inc');
	
	$fId=$_REQUEST['fId'];
	$userId=$conn->real_escape_string($_SESSION['user_id']);
	$queryfavrem = "DELETE FROM favourites WHERE ( userId ='$userId' AND pokId = '$fId' )";
	if ($conn->query($queryfavrem)) {
		echo "success";
	}
	
	else{
		echo $conn->error;
	}
?>