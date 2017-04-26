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
								<p>There was a problem adding the image into DataBase!</p>
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
					case 'exists':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>An image with the same name exists in the DataBase.</p>
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

		<form method='POST' action='managebgs.php' class="admin_form" enctype="multipart/form-data">
		<ul class="dbelements_list">
			<li><span class="dbelements_list_header">MANAGE BACKGROUNDS</span></li>
			
			<?php 

				include ("php/connection.inc");
				$select_bgs = "SELECT * FROM cardbg";

				$res=$conn->query($select_bgs);

				if ($res->num_rows != 0) {
					while ($r = $res->fetch_array()) {
						?>
							<li>
								<span class="dbelement_id"><?php echo $r['bgId'] ?></span>
								<span class="dbelement_img"><img src="<?php echo $r['bglink'] ?>"></span>
								<span class="dbelement_url"><?php echo $r['bglink'] ?></span>
								<span class="dbelement_checkbox">
									<input type='checkbox' name='selectedbgs[]' id='selbgs' value='<?php echo $r['bgId'] ?>'>
								</span>
							</li>
						<?php
					}
				}

				$res->free();
				$conn->close();
				
			?>

			<li>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)" id="remove_bgs"><button name="adm_delete_bgs"><i class="fa fa-trash" aria-hidden="true"></i> <p>Delete Selected Background(s)</p></button></a>
				</span>
			</li>
			<li>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)"><button name="adm_add_bg"><i class="fa fa-file-image-o" aria-hidden="true"></i> <p>Add New Background</p></button></a>
					<span class="admin_upload_btn"><div class="admin_upload_text"><p>Choose image</p></div><input type="file" name="upload_bg" class="admin_upload"/></span>
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