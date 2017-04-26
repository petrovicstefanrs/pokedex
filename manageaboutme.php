<?php 
	include ("php/connection.inc");

	if (isset($_REQUEST['adm_change_aboutme'])) {
		
		$name = $_REQUEST['aboutme_name'];				// ABOUT ME INFORMATION
		$mail = $_REQUEST['aboutme_mail'];
		$studid = $_REQUEST['aboutme_studid'];
		$desc = $_REQUEST['aboutme_desc'];

		$fblink = $_REQUEST['aboutmesocial_fb'];		// ABOUT ME SOCIAL LINKS
		$instalink = $_REQUEST['aboutmesocial_insta'];
		$gitlink = $_REQUEST['aboutmesocial_git'];
		$behlink = $_REQUEST['aboutmesocial_beh'];
		$copenlink = $_REQUEST['aboutmesocial_copen'];

		$img_dir = "images/";												// ABOUT ME IMG UPLOAD
		$img_file = $img_dir . basename($_FILES["upload_img"]["name"]);
		$img_type = pathinfo($img_file,PATHINFO_EXTENSION);
		
		// Check if image file is an image
		$check = getimagesize($_FILES["upload_img"]["tmp_name"]);
	    if($check !== false) {

		    // Check file size
			if ($_FILES["upload_img"]["size"] < 1000000) {

			    // Allow certain file formats
				if($img_type == "jpg" || $img_type == "png" || $img_type == "jpeg" || $img_type == "gif" ) {

					if (move_uploaded_file($_FILES["upload_img"]["tmp_name"], $img_file)) {

						// SIMPLE DATA VALIDATION 

				        $mail=filter_var($mail, FILTER_VALIDATE_EMAIL);	
				        if($mail==false){
				        	$mail="Student Mail Undefined";
				        }
			        	if(trim(strlen($name))==0){
			        		$name="John Doe";
			        	}
			        	if(trim(strlen($studid))==0){
			        		$studid="John Doe / Student Number";
			        	}
			        	if(trim(strlen($desc))==0){
			        		$desc="Description Not Defined!";
			        	}

			        	if(trim(strlen($fblink))==0){
			        		$fblink="#";
			        	}
			        	if(trim(strlen($instalink))==0){
			        		$instalink="#";
			        	}
			        	if(trim(strlen($gitlink))==0){
			        		$gitlink="#";
			        	}
			        	if(trim(strlen($behlink))==0){
			        		$behlink="#";
			        	}
			        	if(trim(strlen($copenlink))==0){
			        		$copenlink="#";
			        	}

			        	// VALIDATION END
			        	
			        	$update_aboutme = "UPDATE aboutme SET myname='$name', mydesc='$desc', mystudid='$studid', myemail='$mail', myimg='$img_file'";

			        	$update_aboutmesocial = "UPDATE aboutmesocial SET fa_link='$fblink', inst_link='$instalink', git_link='$gitlink', bh_link='$behlink', copen_link='$copenlink'";

						if (!$conn->query($update_aboutme) || !$conn->query($update_aboutmesocial)) {
							header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=dbase');
						}
						else{
							header('Location: index.php?rdrpg=adminpanel&sect=aboutme');							
						}

				    } 
				    else {
				        header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=generic');
				    }
				}
				else{
					header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=format');
				}
			}
			else{
				header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=size');
			}
			
	    } 
	    else {
	        header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=notimg');
	    }

	}
	else {
		header('Location: index.php?rdrpg=adminpanel&sect=aboutme&err=generic');
	}
?>