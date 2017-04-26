<?php 
	include ("php/connection.inc");

	if (isset($_REQUEST['adm_delete_regions'])) {
		if (isset($_REQUEST['selectedregions'])) {
			$selectedIDs=$_REQUEST['selectedregions'];
			foreach ($selectedIDs as $id) {
				$rm_region="DELETE FROM regions WHERE regId=$id";

				$conn->query($rm_region);
			}
			header('Location: index.php?rdrpg=adminpanel&sect=regions');
		}
		else{
			header('Location: index.php?rdrpg=adminpanel&sect=regions&err=notselected');
		}
	}
	elseif (isset($_REQUEST['adm_add_region'])) {
		
		$name = $_REQUEST['region_name'];
		$desc = $_REQUEST['region_desc'];

		$img_dir = "images/regions/";												
		$img_file = $img_dir . basename($_FILES["upload_regionimg"]["name"]);
		$img_type = pathinfo($img_file,PATHINFO_EXTENSION);
		
		// Check if image file is an image
		$check = getimagesize($_FILES["upload_regionimg"]["tmp_name"]);
	    if($check !== false) {

		    // Check file size
			if ($_FILES["upload_regionimg"]["size"] < 1000000) {

			    // Allow certain file formats
				if($img_type == "jpg" || $img_type == "png" || $img_type == "jpeg" || $img_type == "gif" ) {

					if (move_uploaded_file($_FILES["upload_regionimg"]["tmp_name"], $img_file)) {
			        	
			        	$add_region = "INSERT INTO regions VALUES(null,'$name','$img_file','$desc')";

						if (!$conn->query($add_region)) {
							header('Location: index.php?rdrpg=adminpanel&sect=regions&err=dbase');
						}
						else{
							header('Location: index.php?rdrpg=adminpanel&sect=regions');							
						}

				    } 
				    else {
				        header('Location: index.php?rdrpg=adminpanel&sect=regions&err=generic');
				    }
				}
				else{
					header('Location: index.php?rdrpg=adminpanel&sect=regions&err=format');
				}
			}
			else{
				header('Location: index.php?rdrpg=adminpanel&sect=regions&err=size');
			}
			
	    } 
	    else {
	        header('Location: index.php?rdrpg=adminpanel&sect=regions&err=notimg');
	    }

	}
	else {
		header('Location: index.php?rdrpg=adminpanel&sect=regions&err=generic');
	}
?>