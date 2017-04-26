<?php 
	session_start();
	include ('php/connection.inc');
	
	$pokeurl="http://pokeapi.co/api/v2/pokemon/";
	$pIds = array();
	$userId=$conn->real_escape_string($_SESSION['user_id']);
	$queryuserfav = "SELECT * FROM favourites WHERE userId ='$userId'";
	$resuserfav = $conn->query($queryuserfav);
	if ($resuserfav->num_rows == 0) {
		echo json_encode("empty");
	}
	else {
		while ($r=$resuserfav->fetch_assoc()) {
			$pIds[]=$pokeurl.$r['pokId'];
		}
		echo json_encode($pIds);
	}
?>