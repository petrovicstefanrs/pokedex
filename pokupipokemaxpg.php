<?php 
	session_start();
	if (isset($_REQUEST['maxpgval'])) {
		$_SESSION['maxpokpg']=$_REQUEST['maxpgval'];
	}
?>