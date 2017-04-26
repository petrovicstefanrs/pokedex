<?php
    
    session_start();
    include ('php/connection.inc');
    $userId=$conn->real_escape_string($_SESSION['user_id']);

    if (isset($_REQUEST['val'])) {
    	$val = json_decode($_REQUEST['val']);
    	$weight = $val->weight;									// Weight
    	$height = $val->height;									// Height
    	$name = $val->name;										// Name
    	$sprites = $val->sprites;				
    	$sprite = $sprites->front_default;						// Sprite URL
        if (is_null($sprite)) {
            $sprite = "images/unknownpoke.png"; 				// Kasnije dodaj u DBase
        }
    	$pok_id = $val->id;										// Poke ID
    	$base_stats = array();
    	$statistics = $val->stats;
    	foreach ($statistics as $s) {
    		$statname = $s->stat->name;
    		$statvalue = $s->base_stat;
    		$base_stats[$statname]=$statvalue;
    	}
    	
    	$hp = $base_stats['hp'];								// Hp
    	$speed = $base_stats['speed'];							// Speed
    	$attack = $base_stats['attack'];						// Attack
    	$defense = $base_stats['defense'];						// Defense
    	$special_attack = $base_stats['special-attack'];		// Special Attack
    	$special_defense = $base_stats['special-defense'];		// Special Defense
    	$description = $_REQUEST['pokeDesc'];					// Description
    	
    	$types = array();										// Pokemon Type(s)
    	$tipovi = $val->types;
    	foreach ($tipovi as $t) {
    		$types[]=$t->type->name;							// Don't have to know the names only the values as I will not sort them
    	}

    	
    	//echo ("hp: ".$hp."speed: ".$speed."attack: ".$attack."def: ".$defense."sp_att: ".$special_attack."sp_def: ".$special_defense);

    }
    else {
    	header('Location: index.php');
    }
    $queryselfav = "SELECT * FROM favourites WHERE ( userId ='$userId' AND pokId = '$pok_id' )";
    $fetchpokId = $conn->query($queryselfav);
    
?>

<div class="bigcard_wrapper">
	<div class="bigcard_card" card-id="<?php echo $pok_id;?>">
		<div class="bigcard_exit_button">
			<span class="bigcard_exitbtn"><a href="javascript:void(0);" class="btn_exit"><i class="fa fa-times" aria-hidden="true"></i></a></span>
		</div>

		<div class="bigcard_info_button">
			<span class="bigcard_infobtn"><a href="javascript:void(0);" class="btn_info"><i class="fa fa-info" aria-hidden="true"></i></a></span>
			<div class="bigcard_info_panel">

				<span class="bigcard_note"><strong>HP</strong>: The Hit Points or HP for short, determine how much <strong>damage</strong> a Pokémon can receive before <strong>fainting</strong>.</span>
				<span class="bigcard_note"><strong>SPEED</strong> : The Speed stat determines the <strong>order</strong> of Pokémon that can act in battle. Pokémon with <strong>higher</strong> Speed at the start of any turn will generally make a move <strong>before</strong> ones with <strong>lower</strong> Speed. In the case that two Pokémon have <strong>the same Speed</strong>, one of them will <strong>randomly</strong> go first.</span>
				<span class="bigcard_note"><strong>ATK</strong>: The Attack stat <strong>partly</strong> determines how much <strong>damage</strong> a Pokémon deals when using a <strong>physical</strong> move.</span>
				<span class="bigcard_note"><strong>DEF</strong>: The Defense stat <strong>partly</strong> determines how much <strong>damage</strong> a Pokémon receives when it is hit with a <strong>physical</strong> move.</span>
				<span class="bigcard_note"><strong>SP_ATK</strong>: The Special Attack stat <strong>partly</strong> determines how much <strong>damage</strong> a Pokémon deals when using a <strong>special</strong> move.</span>
				<span class="bigcard_note"><strong>SP_ DEF</strong>: The Special Defense stat <strong>partly</strong> determines how much <strong>damage</strong> a Pokémon receives when it is hit with a <strong>special</strong> move.</span>
				<span class="bigcard_footnote"><strong>*</strong>All the stat values on this page represent <strong>base stats</strong>!</span>
				</br>
				</br>
				<span class="bigcard_note"><strong>HAPPINES</strong>: The happiness <strong>when caught</strong> by a <strong>normal</strong> Pokéball up to 100%. The <strong>higher</strong> the percentage, the <strong>happier</strong> the Pokémon.</span>
				<span class="bigcard_note"><strong>CAP_RATE</strong>: The base capture rate up to 100%. The <strong>higher</strong> the percentage, the <strong>easier</strong> the catch.</span>
				<span class="bigcard_note"><strong>GENDER</strong>: The chance of this Pokémon <strong>being female</strong>, in percentage. If pokemon is <strong>genderless</strong> the stat will be <strong>'genderless'</strong>.</span>

			</div>
		</div>

		<div class="bigcard_left_info">
			<div class="bigcard_info">
				<span class="pokename"><?php echo "#".$pok_id." ".$name;?></span>
				<span class="pokedesc"><?php echo $description;?></span>
				<div class="bigcard_stats">
					<span class="bigcard_stat_val"><p>HP:</p><?php echo $hp;?></span>
					<span class="bigcard_stat_val"><p>SPEED:</p><?php echo $speed;?></span>
					<span class="bigcard_stat_val"><p>ATK:</p><?php echo $attack;?></span>
					<span class="bigcard_stat_val"><p>DEF:</p><?php echo $defense;?></span>
					<span class="bigcard_stat_val"><p>SP_ATK:</p><?php echo $special_attack;?></span>
					<span class="bigcard_stat_val"><p>SP_DEF:</p><?php echo $special_defense;?></span>
				</div>
				<div class="bigcard_types">
					<span class="bigcard_types_title">TYPES: |</span>
					<?php foreach ($types as $t) {
						?>
							<span class="bigcard_type"><?php echo " ".$t." |"; ?></span>
						<?php
					} ?>
				</div>
				<div class="other_stats">
					
				</div>
			</div>
		</div>
		<div class="bigcard_right_img">
			<img src=<?php echo "'".$sprite."'"?> class="bigcard_img">
			
			<div class="bigcard_fav_button">
				<?php 
                    if($fetchpokId->num_rows == 0) {
                        ?>
                            <span class="bigcard_favbtn"><a href="javascript:void(0);" onclick="addToFavourites(<?php echo "'".$name."',".$pok_id;?>)" class="btn_fav"><i class="fa fa-heart-o" id="favIcon" ></i></a></span>    
                        <?php
                    }
                    else {
                        ?>
                            <span class="bigcard_favbtn"><a href="javascript:void(0);" onclick="removeFromFavourites(<?php echo "'".$name."',".$pok_id;?>)" class="btn_fav"><i class="fa fa-heart" id="favIcon" ></i></a></span>
                        <?php
                    }

                ?>

			</div>
		</div>
	</div>
</div>