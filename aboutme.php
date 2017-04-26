<?php 
	include ("php/connection.inc");

	$query1 = "SELECT * FROM aboutme";
	$res1 = $conn->query($query1);
	$r1 = $res1->fetch_assoc();

	$query2 = "SELECT * FROM aboutmesocial";
	$res2 = $conn->query($query2);
	$r2 = $res2->fetch_assoc();
?>
<div class="aboutme_wrapper">
	<div class="aboutme_card">
		<div class="aboutme_left_info">
			<div class="author_info">
				<span class="authorname"><?php echo $r1['myname']?></span>
				<span class="authordesc"><?php echo $r1['mydesc'];?></span>
				<span class="authorstudentid"><?php echo $r1['mystudid'];?></span>
				<span class="studentmail"><?php echo $r1['myemail'];?></span>

			</div>
		</div>
		<div class="aboutme_right_img">
			<img src=<?php echo "'".$r1['myimg']."'"?> class="author_img">
			<span class="social_icons">
				<a href=<?php echo "'".$r2['fa_link']."'";?>><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href=<?php echo "'".$r2['inst_link']."'";?>><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<a href=<?php echo "'".$r2['git_link']."'";?>><i class="fa fa-github-square" aria-hidden="true"></i></a>
				<a href=<?php echo "'".$r2['bh_link']."'";?>><i class="fa fa-behance-square" aria-hidden="true"></i></a>
				<a href=<?php echo "'".$r2['copen_link']."'";?>><i class="fa fa-codepen" aria-hidden="true"></i></a>
			</span>
		</div>
	</div>
</div>