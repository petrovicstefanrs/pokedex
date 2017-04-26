<?php 
	include ('php/connection.inc');
	
	$bgs = array();
	$querybg = "SELECT * FROM cardbg";
	$resbg = $conn->query($querybg);
	while ($r=$resbg->fetch_assoc()) {
		$bgs[]='url('.$r['bglink'].')';
	}
	echo json_encode($bgs);
?>