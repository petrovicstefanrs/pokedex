<div class="card-container">
        
    <div class="card-wrapper region-wrapper">

<?php
    include ('php/connection.inc');
    //$userId=$conn->real_escape_string($_SESSION['user_id']);

    
    	$queryregion = "SELECT * FROM regions";
		$res1 = $conn->query($queryregion);
		while ($r1 = $res1->fetch_assoc()) {
			?>

			<div class="poke-card region-card" data-id="<?php echo $r1['regId'];?>" style="order:<?php echo $r1['regId'];?>;">
			<a href='javascript:void(0);'>
		        <div class="card-glare"></div>

		        <div class="sprite-bg">
		            <img src=<?php echo "'".$r1['regImg']."'";?> class="poke-sprite">
		        </div>

		        <div class="pokeinfo-bg">
		            <span class="poke-name"><p><?php echo "#".$r1['regId']." ".$r1['regName'];?></p></span>
		            <span class="poke-desc"><p><?php echo $r1['regDesc'];?></p></span>
		        </div>

		        </a>
		    </div>

			<?php
		}
    

?>

    </div>

</div>


