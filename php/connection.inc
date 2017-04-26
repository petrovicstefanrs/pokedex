<?php
	$server="SERVER";
	$user="DB USER";
	$pass="DB PASS";
	$dbase = "DBASE";	// Postavi ima dbase obavezno

	$conn = new mysqli($server, $user, $pass, $dbase);
	
	if ($conn->connect_error) {
		die("Connection to database has failed: ".$conn->connect_error);
	}

	$conn->set_charset("utf8");  // Postavljam charset na UTF8 da bi odgovarao charset-u dbase

	//echo "Connection Successfull.";
?>