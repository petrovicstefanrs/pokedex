<?php 

	if (isset($_REQUEST['sect'])=='backgrounds') {
		?>
		<div class="dbelements_list_wrapper">

		<?php // HANDLING ERROR MESSAGES
			if (isset($_REQUEST['err'])) {
				switch ($_REQUEST['err']) {
					case 'dbase':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>There was a problem updating data to DataBase!</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					case 'generic':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>We encountered an error!</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					case 'format':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>The image must be either JPG, PNG or GIF.</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					case 'size':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>The image must be below 1MB.</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					case 'notimg':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>You must upload an image.</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					default:
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>We encountered an error!</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
				}
			}
		?>

		<form method='POST' action='manageaboutme.php' class="admin_form" enctype="multipart/form-data">
		<ul class="dbelements_list">
			<li><span class="dbelements_list_header">MANAGE ABOUT ME SECTION</span></li>
			
			<?php 

				include ("php/connection.inc");
				$select_aboutme = "SELECT * FROM aboutme";
				$res=$conn->query($select_aboutme);

				if ($res->num_rows != 0) {
					while ($r = $res->fetch_array()) {
						?>
							<!-- HIGH LIST ITEM FOR IMAGE AND DESCRIPTION -->
							<li class="high_list_item">	
								<span class="dbelement_img"><img src="<?php echo $r['myimg'] ?>"></span>
								<span class="dbelement_desc"><?php echo $r['mydesc'] ?></span>
							</li>
							<!-- OTHER INFO -->
							<li>
								<span class="dbelement_text"><strong>Name: &nbsp</strong> <?php echo $r['myname'] ?></span>
								<span class="dbelement_text"><strong>StudentID: &nbsp</strong> <?php echo $r['mystudid'] ?></span>
								<span class="dbelement_text"><strong>StudentMail: &nbsp</strong> <?php echo $r['myemail'] ?></span>
							</li>
						<?php
					}
				}


				$select_aboutmesocial = "SELECT * FROM aboutmesocial";
				$res2=$conn->query($select_aboutmesocial);

				if ($res2->num_rows != 0) {
					while ($r2 = $res2->fetch_array()) {
						?>
							<!-- SOCIAL LINKS -->
							<li class="list_item_hoverable">
								<span class="dbelement_text"><i class="fa fa-facebook-official"></i><?php echo $r2['fa_link'] ?></span>
								<span class="dbelement_text"><i class="fa fa-instagram"></i><?php echo $r2['inst_link'] ?></span>
								<span class="dbelement_text"><i class="fa fa-github-square"></i><?php echo $r2['git_link'] ?></span>
								<span class="dbelement_text"><i class="fa fa-behance-square"></i><?php echo $r2['bh_link'] ?></span>
								<span class="dbelement_text"><i class="fa fa-codepen"></i><?php echo $r2['copen_link'] ?></span>
							</li>
						<?php
					}
				}

				$res->free();
				$res2->free();
				$conn->close();
				
			?>

			<li class="list_item_separated">
				<span class="dbelements_list_options">
					<input type="text" name="aboutme_studid" placeholder="StudentID">
					<input type="text" name="aboutme_mail" placeholder="StudentMail">
					<input type="text" name="aboutme_name" placeholder="John Doe">
					<span class="admin_upload_btn small_btn"><div class="admin_upload_text"><p>Choose image</p></div><input type="file" name="upload_img" class="admin_upload"/></span>
				</span>
				<span class="dbelements_list_options">
					<input type="text" name="aboutmesocial_copen" placeholder="CodePen Link">
					<input type="text" name="aboutmesocial_beh" placeholder="Behance Link">
					<input type="text" name="aboutmesocial_git" placeholder="Github Link">
					<input type="text" name="aboutmesocial_insta" placeholder="Instagram Link">
					<input type="text" name="aboutmesocial_fb" placeholder="Facebook Link">
				</span>
				<span class="dbelements_list_options options_high">
					<textarea rows="5" cols="50" maxlength="500" placeholder="New Description(MAX 500 Characters)" name="aboutme_desc" ></textarea>
				</span>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)"><button name="adm_change_aboutme"><i class="fa fa-upload" aria-hidden="true"></i> <p>Submit New Info</p></button></a>
				</span>
			</li>
		</ul>
		</form>
		</div>
		<?php
	}
	else{

	}
?>