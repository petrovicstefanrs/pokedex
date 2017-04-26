<?php

    if (isset($_REQUEST['dataval'])) {
    	$val = json_decode($_REQUEST['dataval']);
        $happy = $val->base_happiness;
        $pcthappy = ceil(($happy*100)/255);                     // Base happiness
        $capt = $val->capture_rate;
        $pctcaptrate = ceil(($capt*100)/255);                   // Capture rate
        $gender = $val->gender_rate;
        if($gender==-1){
            $pctgender = "Genderless";                               // Genderless
        }
        else {
            $pctgender = ($gender*100)/8;                           // Chance of being female
        }
        $growthrate = $val->growth_rate->name;                  // Growth rate
        $generation = $val->generation->name;                   // Generation

    }
    else {
        header('Location: index.php');
    }
    
?>

<div class="bigcard_stats">
    <span class="bigcard_stat_val"><p>HAPPINESS:</p><?php echo $pcthappy."%";?></span>
    <span class="bigcard_stat_val"><p>CAP_RATE:</p><?php echo $pctcaptrate."%";?></span>
    <span class="bigcard_stat_val"><p>GENDER:</p><?php echo $pctgender."%";?></span>
</div>
<div class="bigcard_types">
    <span class="bigcard_types_title">GROWTH RATE: |</span>
    <span class="bigcard_type"><?php echo " ".$growthrate." |"; ?></span>
    </br>
    </br>
    <span class="bigcard_types_title">GENERATION: |</span>
    <span class="bigcard_type"><?php echo " ".$generation." |"; ?></span>
</div>