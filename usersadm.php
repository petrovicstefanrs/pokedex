<?php 
	if (isset($_REQUEST['sect'])=='users') {
		?>
		<div class="dbelements_list_wrapper">

		<?php // HANDLING ERROR MESSAGES
			if (isset($_REQUEST['err'])) {
				switch ($_REQUEST['err']) {
					case 'dbase':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>There was a problem with our DataBase!</p>
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
					case 'notselected':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>You have to select at least one user.</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						break;
					case 'usrpass':
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>Username & password must be longer then 5 characters!</p>
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

		<form method='POST' action='manageusers.php' class="admin_form">
		<ul class="dbelements_list">
			<li><span class="dbelements_list_header">MANAGE USERS</span></li>
			<?php 

				include ("php/connection.inc");
				$upit_users = "SELECT * FROM users u JOIN user_role ur ON u.id_user=ur.id_user JOIN roles r ON r.id_role=ur.id_role";

				$res=$conn->query($upit_users);

				if ($res->num_rows != 0) {
					while ($r = $res->fetch_array()) {
						if ($r['id_role']==1) {
						?>
							<li class="admin_element">
								<span class="dbelement_id"><?php echo $r['id_user'] ?></span>
								<span class="dbelement_name"><?php echo $r['username'] ?></span>
								<span class="dbelement_pass"><?php echo $r['password'] ?></span>
								<span class="dbelement_checkbox">
									<input type='checkbox' name='selectedusers[]' id='selusers' value='<?php echo $r['id_user'] ?>'>
								</span>
							</li>
						<?php
						}
						else{
						?>
							<li>
								<span class="dbelement_id"><?php echo $r['id_user'] ?></span>
								<span class="dbelement_name"><?php echo $r['username'] ?></span>
								<span class="dbelement_pass"><?php echo $r['password'] ?></span>
								<span class="dbelement_checkbox">
									<input type='checkbox' name='selectedusers[]' id='selusers' value='<?php echo $r['id_user'] ?>'>
								</span>
							</li>
						<?php
						}
					}
				}

				$res->free();
				$conn->close();
				
			?>
			<li>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)" id="remove_users"><button name="adm_delete_users"><i class="fa fa-trash" aria-hidden="true"></i> <p>Delete Selected User(s)</p></button></a>	
					<a href="javascript:void(0)" id="promote_users"><button name="adm_promote_users"><i class="fa fa-lock" aria-hidden="true"></i> <p>Promote Selected User(s) to Admin(s)</p></button></a>	
					<a href="javascript:void(0)" id="demote_users"><button name="adm_demote_users"><i class="fa fa-unlock" aria-hidden="true"></i> <p>Demote Selected Admin(s) to User(s)</p></button></a>	
				</span>
			</li>
			<li>
				<span class="dbelements_list_options">
					<a href="javascript:void(0)"><button name="adm_add_user"><i class="fa fa-user-plus" aria-hidden="true"></i> <p>Add New User</p></button></a>
					<input type="password" name="newuser_pass" placeholder="Password">
					<input type="text" name="newuser_name" placeholder="Username">
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