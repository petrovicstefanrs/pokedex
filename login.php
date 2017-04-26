<?php
	
	include ("php/connection.inc");

	if (isset($_REQUEST['logname'])) {
		$username=trim($_REQUEST['logname']);
		$password=md5($_REQUEST['logpass']);

		$upit_login = "SELECT * FROM users u JOIN user_role ur ON u.id_user=ur.id_user JOIN roles r ON r.id_role=ur.id_role WHERE username='$username' AND password = '$password'";

		$res=$conn->query($upit_login);

		if ($res->num_rows != 0) {
			$r = $res->fetch_array();
			//session_start();
			if (!isset($_SESSION['role'])) {
				session_start();
				$_SESSION['id_r'] = $r['id_role'];
				$_SESSION['role'] = $r['role_name'];
				$_SESSION['username'] = $r['username'];
				$_SESSION['user_id'] = $r['id_user'];
				
				// TIMEOUT VAR FOR SESSION DURATION
				$_SESSION['timeout'] = time();

				echo "success";
				exit();
			}
		}

		else {
			$login_err="Please check your username and password</br>and try again!";
			echo $login_err;
		}

		/* free result set */
		$res->free();

		/* close connection */
		$conn->close();
	}

	else{
		header('Location: index.php');
	}
?>