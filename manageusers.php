<?php 
	include ("php/connection.inc");

	if (isset($_REQUEST['adm_delete_users'])) {
		if (isset($_REQUEST['selectedusers'])) {
			$selectedIDs=$_REQUEST['selectedusers'];
			foreach ($selectedIDs as $id) {
				$rm_user="DELETE FROM users WHERE id_user=$id";
				$rm_user_role="DELETE FROM user_role WHERE id_user=$id";
				$rm_user_favs="DELETE FROM favourites WHERE userId=$id";
				
				$conn->query($rm_user);
				$conn->query($rm_user_role);
				$conn->query($rm_user_favs);
			}
			header('Location: index.php?rdrpg=adminpanel&sect=users');
		}
		else{
			header('Location: index.php?rdrpg=adminpanel&sect=users&err=notselected');
		}
	}
	elseif (isset($_REQUEST['adm_promote_users'])) {
		if (isset($_REQUEST['selectedusers'])) {
			$selectedIDs=$_REQUEST['selectedusers'];
			foreach ($selectedIDs as $id) {
				$promote_user_role="UPDATE user_role SET id_role=1 WHERE id_user=$id";
				
				$conn->query($promote_user_role);
			}
			header('Location: index.php?rdrpg=adminpanel&sect=users');
		}
		else{
			header('Location: index.php?rdrpg=adminpanel&sect=users&err=notselected');
		}
	}
	elseif (isset($_REQUEST['adm_demote_users'])) {
		if (isset($_REQUEST['selectedusers'])) {
			$selectedIDs=$_REQUEST['selectedusers'];
			foreach ($selectedIDs as $id) {
				$promote_user_role="UPDATE user_role SET id_role=2 WHERE id_user=$id";
				
				$conn->query($promote_user_role);
			}
			header('Location: index.php?rdrpg=adminpanel&sect=users');
		}
		else{
			header('Location: index.php?rdrpg=adminpanel&sect=users&err=notselected');
		}
	}
	elseif (isset($_REQUEST['adm_add_user'])) {
		$username=$_REQUEST['newuser_name'];
		$password=md5($_REQUEST['newuser_pass']);
		
		if(strlen($username)<5 || strlen($password)<5){
			header('Location: index.php?rdrpg=adminpanel&sect=users&err=usrpass');
		}
		else{
			$newuser="INSERT INTO users VALUES(null,'$username','$password')";
			if (!$conn->query($newuser)) {
				header('Location: index.php?rdrpg=adminpanel&sect=users&err=dbase');
			}
			else{
				$newuserid="SELECT * FROM users WHERE id_user = ( SELECT MAX(id_user) FROM users)";
				if (!$fetchuserid=$conn->query($newuserid)) {
					header('Location: index.php?rdrpg=adminpanel&sect=users&err=dbase');
				}
				else{
					while ($r=$fetchuserid->fetch_array(MYSQLI_ASSOC)) {
						$iduserrole=$r['id_user'];
					}

					$newuserrole="INSERT INTO user_role VALUES(null, '$iduserrole' ,'2')";
					if (!$conn->query($newuserrole)) {
						header('Location: index.php?rdrpg=adminpanel&sect=users&err=dbase');
					}
					else{
						header('Location: index.php?rdrpg=adminpanel&sect=users');
					}
				}
			}
		}
		
	}
	else {
		header('Location: index.php?rdrpg=adminpanel&sect=users&sect=generic');
	}
?>