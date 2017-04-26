<!-- Loader for processing admin tasks -->

<div id="search_loader">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="search_loader_notif">Searching...</span>             
</div>


<?php 
    if (isset($_REQUEST['rdrpg'])) {
        switch ($_REQUEST['rdrpg']) {
            case 'adminpanel':
            if (isset($_REQUEST['sect'])) {
                switch ($_REQUEST['sect']) {
                    case 'users':
                        include ('usersadm.php');
                        break;

                    case 'backgrounds':
                        include ('backgroundsadm.php');
                        break;

                    case 'regions':
                        include ('regionsadm.php');
                        break;
                    
                    case 'aboutme':
                        include ('aboutmeadm.php');
                        break;

                    default:
                        header('Location: index.php?rdrpg=adminpanel');
                        break;
                }
            }
            else {
                ?>
                    <div class='empty_adm'><img src='images/empty_poke.png'><span>To start managing the website</span><span>Click on one of the links from side menu.</span></div>
                <?php
            }
            break;

            default:
                header('Location: index.php?rdrpg=adminpanel');
                break;
        }
    }

?>


<!-- Admin panel Navigation -->

<nav class="main-menu">
    <ul>
        <li>
            <a href="index.php?rdrpg=adminpanel&sect=users">
                <i class="fa fa-address-card fa-2x"></i>
                <span class="nav-text">
                    Users
                </span>
            </a>
          
        </li>
        <li class="has-subnav">
            <a href="index.php?rdrpg=adminpanel&sect=backgrounds">
                <i class="fa fa-picture-o fa-2x"></i>
                <span class="nav-text">
                    Card Backgrounds
                </span>
            </a>
            
        </li>
        <li class="has-subnav">
            <a href="index.php?rdrpg=adminpanel&sect=regions">
               <i class="fa fa-map-marker fa-2x"></i>
                <span class="nav-text">
                    Regions Data
                </span>
            </a>
           
        </li>
        <li>
            <a href="index.php?rdrpg=adminpanel&sect=aboutme">
               <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">
                    About Me Data
                </span>
            </a>
        </li>
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