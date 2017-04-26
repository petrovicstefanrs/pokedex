<?php
	session_start();

	if (isset($_SESSION['id_r'])) {
		unset($_SESSION['id_r']);
		unset($_SESSION['role']);
		unset($_SESSION['username']);
		unset($_SESSION['maxpokpg']);
		unset($_SESSION['user_id'] );
		session_destroy();

		if (isset($_REQUEST['notif'])) {
			if($_REQUEST['notif']=="session_expired"){	// IF PASSED NOTIF IS SESSION EXPIRATION FORWARD THE NOTIF BACK TO INDEX
				header('Location:index.php?notif=session_expired');
			}
		}
		else{
			header('Location:index.php');	
		}
		
	}
	else
	{
		header('Location:index.php');
	}
?>