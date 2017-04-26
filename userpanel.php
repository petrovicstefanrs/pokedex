<div class="area">

    <div id="ajax_loader">
        <p class="loader-note">Please note that PokeAPI is SLOW</br>Loading the page can take up from 30s to 1min</p>
        <img src="images/ajax_loader.gif">
        <div class="loadbar-wrapper">
            <div class="loadbar-bar"></div>
        </div>
    </div>
    
    <div id="card_loader">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="card_loader_notif">Loading...</span>
        <div class="loadbar-wrapper">
            <div class="loadbar-bar-card"></div>
        </div>
    </div>

    <div id="search_loader">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="search_loader_notif">Searching...</span>             
    </div>
    
    <?php 

    if (isset($_REQUEST['rdrpg'])) {
        switch ($_REQUEST['rdrpg']) {
                                 
            case 'pokedex':
                if (isset($_REQUEST['pg'])) {
                    if ($_REQUEST['pg']<0) {
                        header('Location: index.php?rdrpg=pokedex');
                    }
                    elseif ($_REQUEST['pg']>$_SESSION['maxpokpg']) {
                        header('Location: index.php?rdrpg=pokedex');  
                    }
                    else{
                        $page=$_REQUEST['pg'];
                        //var_dump($_SESSION['maxpokpg']);
                    }
                }
                else{
                    if (isset($_REQUEST['sect'])) {
                        switch ($_REQUEST['sect']) {
                            /*case 'aboutauthor':
                                include ('aboutme.php');
                                break;*/
                            
                            case 'favourites':
                                ?>
                                <script type="text/javascript" src="javascript/script_jquery_favpage_ajax.js"></script>
                                <div class="card-container">
        
                                    <div class="card-wrapper">
                                        
                                    </div>

                                </div>
                                <?php
                                break;

                            // case 'regions':
                            //     include ('regions.php');
                            //     break;

                            default:
                                header('Location: index.php?rdrpg=pokedex&sect=favourites');
                                break;
                        }
                    }
                    else{
                        $page=1;    
                    }
                }
                
                if (isset($page)) {
                    if($page==1){
                        $offset="";
                        ?>
                            <script type="text/javascript">
                                var urloffset=<?php echo "'".$offset."'";?>;
                            </script> 

                            <script type="text/javascript" src="javascript/script_jquery_ajax.js"></script>
                        <?php
                    }
                    else {
                        $offset="?offset=".(($page-1)*20);
                        ?>
                            <script type="text/javascript">
                                var urloffset=<?php echo "'".$offset."'";?>;
                            </script> 

                            <script type="text/javascript" src="javascript/script_jquery_ajax.js"></script>
                        <?php
                    }

                    ?>

                        <div class="card-container">
                            <div class="searchbar_container">
                            
                            <div class="searchbar">
                                <span class="search_icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                <input type="text" name="tb_search" id="searchname" class="searchnamefield" placeholder="Pikachu">
                            </div>

                        </div>
                            <div class="card-wrapper">
                                
                            </div>
                            <div class="search-wrapper">
                                
                            </div>

                        </div>
                    <?php
                }
                break;

            // case 'aboutauthor':
            //     include ('aboutme.php');
            //     break;

            default:
                    header('Location: index.php?rdrpg=pokedex');
                break;
        }
    }


    ////////////////////////////////////////// Pagination ///////////////////////////////////////////

        if (isset($page)) {
            echo "<div class='pagination-wrapper'>";

            if($page==1){
                echo "<span class='pag-arrow pag-prev pag-arrow-hidden'><a href=''><i class='fa fa-chevron-left' aria-hidden='true'></i></a></span>";
            }
            else{
                echo "<span class='pag-arrow pag-prev'><a href='index.php?rdrpg=pokedex&pg=".($page-1)."'><i class='fa fa-chevron-left' aria-hidden='true'></i></a></span>";
            }
            
            if ($page>=$_SESSION['maxpokpg']-9) {
                echo "<ul class='pag-nums'>";
                    for ($i=1; $i < 10; $i++) { 
                        echo "<a href='index.php?rdrpg=pokedex&pg=".(($_SESSION['maxpokpg']-9)+$i)."'><li>".(($_SESSION['maxpokpg']-9)+$i)."</li></a>";
                    }
                echo "</ul>";
            }
            else{
                echo "<ul class='pag-nums'>";
                    for ($i=1; $i < 10; $i++) { 
                        echo "<a href='index.php?rdrpg=pokedex&pg=".($page+$i)."'><li>".($page+$i)."</li></a>";
                    }
                echo "</ul>";
            }

            if($page==$_SESSION['maxpokpg']){
                echo "<span class='pag-arrow pag-next pag-arrow-hidden'><a href=''><i class='fa fa-chevron-right' aria-hidden='true'></i></a></span>";
            }
            else{
                echo "<span class='pag-arrow pag-next'><a href='index.php?rdrpg=pokedex&pg=".($page+1)."'><i class='fa fa-chevron-right' aria-hidden='true'></i></a></span>";
            }
        }


    ?>


</div>

<nav class="main-menu">
    <ul>
        <li>
            <a href="index.php?rdrpg=pokedex">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                    Pokédex (All pokémon)
                </span>
            </a>
          
        </li>
        <li class="has-subnav">
            <a href="index.php?rdrpg=pokedex&sect=favourites">
                <i class="fa fa-heart fa-2x"></i>
                <span class="nav-text">
                    Favourites
                </span>
            </a>
            
        </li>
        <li>
            <a href="#!">
               <i class="fa fa-2x fa-github" aria-hidden="true"></i>
                <span class="nav-text">
                    Fork on GitHub
                </span>
            </a>
        </li>
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fpokedex.petrovicstefan.rs%2F&src=sdkpreparse" target="_blank">
                <i class="fa fa-2x fa-facebook" aria-hidden="true"></i>
                <span class="nav-text">
                    Share On Facebook
                </span>
            </a>
        </li>
        <li>
            <!-- Twitter Twitt -->
            <a target="_blank"
                href="https://twitter.com/intent/tweet?text=pokedex.petrovicstefan.rs%20Pokemon%20Pokedex,%20Powered%20By%20Pokéapi.">
                <i class="fa fa-2x fa-twitter" aria-hidden="true"></i>
                <span class="nav-text">
                    Tweet
                </span></a>
        </li>
        <!-- <li class="has-subnav">
            <a href="index.php?rdrpg=pokedex&sect=regions">
               <i class="fa fa-map-marker fa-2x"></i>
                <span class="nav-text">
                    Regions
                </span>
            </a>
           
        </li> -->
        <!-- <li>
            <a href="index.php?rdrpg=aboutauthor">
               <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">
                    About The Creator
                </span>
            </a>
        </li>
        <li>
            <a href="doc/documentation.pdf">
               <i class="fa fa-info fa-2x"></i>
                <span class="nav-text">
                    Documentation
                </span>
            </a>
        </li> -->
    </ul>

    <ul class="logout">
        <li>
           <a href="logout.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                    Logout
                </span>
            </a>
        </li>  
    </ul>
</nav>

