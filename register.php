<?php
	session_start();
	include ("php/connection.inc");

	if (isset($_REQUEST['regname'])) {
		$username=$_REQUEST['regname'];
		$password=md5($_REQUEST['regpass']);
		$repassword=md5($_REQUEST['reregpass']);
		if((!empty($username) && !empty($password) && !empty($repassword))&&($password==$repassword)){
			
			$regupit="INSERT INTO users VALUES(null,'$username','$password')";
			$conn->query($regupit);
			
			$newuserid="SELECT * FROM users WHERE id_user = ( SELECT MAX(id_user) FROM users)";
			$fetchuserid=$conn->query($newuserid);
			while ($r=$fetchuserid->fetch_array(MYSQLI_ASSOC)) {
				$iduserrole=$r['id_user'];
			}

			$userrole="INSERT INTO user_role VALUES(null, '$iduserrole' ,'2')";
			$conn->query($userrole);
			//$_SESSION['reg_stat']="regsuc"; Discarded this approach 
			//header('Location: index.php');

			/*
			$favupit="CREATE TABLE `".$iduserrole."_favourites` ( favId INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, pokname VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , pokId INT(10) NOT NULL)";
			$conn->query($favupit);*/

			echo "Thank you for registering!";
		}
		else{
			//$_SESSION['reg_stat']="regerr";
			//header('Location: index.php');
			echo "Ooops! There was some kind of mistake. Please try later.";
		}
	}
	else{
		header('Location: index.php');
	}
	
?>