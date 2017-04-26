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
								<p>There was a problem adding the region into DataBase!</p>
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
					case 'notselected':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>You have to select at least one region.</p>
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

		<form method='POST' action='manageregions.php' class="admin_form" enctype="multipart/form-data">
		<ul class="dbelements_list">
			<li><span class="dbelements_list_header">MANAGE REGIONS</span></li>
			
			<?php 

				include ("php/connection.inc");
				$select_regions = "SELECT * FROM regions";

				$res=$conn->query($select_regions);

				if ($res->num_rows != 0) {
					while ($r = $res->fetch_array()) {
						?>
							<li class="region_elements">
								<span class="dbelement_id"><?php echo $r['regId'] ?></span>
								<span class="dbelement_img"><img src="<?php echo $r['regImg'] ?>"></span>
								<span class="dbelement_name"><?php echo $r['regName'] ?></span>
								<span class="dbelement_text"><?php $string=(strlen($r['regDesc']) > 133) ? substr($r['regDesc'],0,130).'...' : $r['regDesc']; echo $string; ?></span>
								<span class="dbelement_checkbox">
									<input type='checkbox' name='selectedregions[]' id='selregions' value='<?php echo $r['regId'] ?>'>
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
					<a href="javascript:void(0)" id="remove_regions"><button name="adm_delete_regions"><i class="fa fa-trash" aria-hidden="true"></i> <p>Delete Selected Region(s)</p></button></a>
				</span>
			</li>

			<li class="list_item_separated">
				<span class="dbelements_list_options">
					<input type="text" name="region_name" placeholder="Region Name">
					<span class="admin_upload_btn small_btn"><div class="admin_upload_text"><p>Choose image</p></div><input type="file" name="upload_regionimg" class="admin_upload"/></span>
				</span>
				<span class="dbelements_list_options options_high">
					<textarea rows="5" cols="50" maxlength="500" placeholder="New Region Description(MAX 500 Characters)" name="region_desc" ></textarea>
				</span>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)"><button name="adm_add_region"><i class="fa fa-upload" aria-hidden="true"></i> <p>Add New Region</p></button></a>
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