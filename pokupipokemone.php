

<?php
    
    session_start();
    include ('php/connection.inc');
    $userId=$conn->real_escape_string($_SESSION['user_id']);

    if (isset($_REQUEST['val'])) {
    	$val = json_decode($_REQUEST['val']);
    	$weight = $val->weight;
    	$height = $val->height;
    	$name = $val->name;
    	$sprites = $val->sprites;
    	$sprite = $sprites->front_default;
        if (is_null($sprite)) {
            $sprite = "images/unknownpoke.png"; // Kasnije dodaj u DBase
        }
    	$pok_id = $val->id;
        $pageid = $_REQUEST['pgid'];
    	//var_dump("id:".$pok_id."</br>");

    }
    else {
        header('Location: index.php');
    }

    $queryselfav = "SELECT * FROM favourites WHERE ( userId ='$userId' AND pokId = '$pok_id' )";
    $fetchpokId = $conn->query($queryselfav);
    

    if ($pageid=="favourites") {
        ?>
            <div class="poke-card in_fav" data-id="<?php echo $pok_id;?>" style="order:<?php echo $pok_id;?>;">
        <?php
    }

    else{
        ?>
            <div class="poke-card" data-id="<?php echo $pok_id;?>" style="order:<?php echo $pok_id;?>;">
        <?php
    }
?>

<!--<div class="poke-card" data-id="<?php echo $pok_id;?>" style="order:<?php echo $pok_id;?>;"> -->
        <a href='javascript:void(0);' class="open_card">
        <div class="card-glare"></div>

        <div class="sprite-bg">
            <img src=<?php echo "'".$sprite."'";?> class="poke-sprite">
        </div>

        <div class="pokeinfo-bg">
            <span class="poke-name"><p><?php echo "#".$pok_id." ".$name;?></p></span>
            <span class="poke-desc"><p>There is no description for this pokémon</p></span>
        </div>

        </a>
        <div class="content-bg">
            <div class="poke-stats">
                <span class="stat-caption"><p>Height:</p></span>
                <span class="stat-value"><p><?php echo $height/10;?>m</p></span>
            </div>
            <div class="poke-stats">
                <span class="stat-caption"><p>Weight:</p></span>
                <span class="stat-value"><p><?php echo $weight/10;?>kg</p></span>
            </div>
            <div class="poke-stats no-border">
                <?php 
                    if($fetchpokId->num_rows == 0) {
                        ?>
                            <span class="stat-value"><a href="javascript:void(0);" onclick="addToFavourites(<?php echo "'".$name."',".$pok_id;?>)" class="btn_fav"><i class="fa fa-heart-o" id="favIcon" ></i></a></span>    
                        <?php
                    }
                    else {
                        ?>
                            <span class="stat-value"><a href="javascript:void(0);" onclick="removeFromFavourites(<?php echo "'".$name."',".$pok_id;?>)" class="btn_fav"><i class="fa fa-heart" id="favIcon" ></i></a></span>
                        <?php
                    }

                ?>
            </div>
        </div>
    </div>

    <?php 
        if ($pageid=="search") {
            ?>
                <div class="backtodex"><i class="fa fa-chevron-left" aria-hidden="true"></i><span> BACK TO POKÉDEX</span></div>
            <?php
        }
    ?>
