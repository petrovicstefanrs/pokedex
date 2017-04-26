<?php 
	include ("php/connection.inc");

	if (isset($_REQUEST['adm_delete_bgs'])) {
		if (isset($_REQUEST['selectedbgs'])) {
			$selectedIDs=$_REQUEST['selectedbgs'];
			foreach ($selectedIDs as $id) {
				$rm_bg="DELETE FROM cardbg WHERE bgId=$id";
				$conn->query($rm_bg);
			}
			header('Location: index.php?rdrpg=adminpanel&sect=backgrounds');
		}
		else{
			header('Location: index.php?rdrpg=adminpanel&sect=backgrounds');
		}
	}
	elseif (isset($_REQUEST['adm_add_bg'])) {
		$bgs_dir = "images/pokecards/";
		$bg_file = $bgs_dir . basename($_FILES["upload_bg"]["name"]);
		$bg_type = pathinfo($bg_file,PATHINFO_EXTENSION);
		$greske = 0;
		
		// Check if image file is an image
		$check = getimagesize($_FILES["upload_bg"]["tmp_name"]);
	    if($check !== false) {
	    	
	        // Check if file already exists
			if (!file_exists($bg_file)) {

			    // Check file size
				if ($_FILES["upload_bg"]["size"] < 1000000) {

				    // Allow certain file formats
					if($bg_type == "jpg" || $bg_type == "png" || $bg_type == "jpeg" || $bg_type == "gif" ) {

						if (move_uploaded_file($_FILES["upload_bg"]["tmp_name"], $bg_file)) {
					        $addbg = "INSERT INTO cardbg VALUES(null ,'$bg_file')";
							if (!$conn->query($addbg)) {
								header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=dbase');
							}
							else{
								header('Location: index.php?rdrpg=adminpanel&sect=backgrounds');
							}
					    } else {
					        header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=generic');
					    }
					}
					else{
						header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=format');
					}
				}
				else{
					header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=size');
				}
			}
			else{
				header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=exists');
			}
	    } 
	    else {
	        header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=notimg');
	    }

	}
	else {
		header('Location: index.php?rdrpg=adminpanel&sect=backgrounds&err=generic');
	}
?>