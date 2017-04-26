<?php 
	session_start();
	$timeout = 60*60; // NUMBER OF SECONDS UNTIL TIMEOUT (*60 - THIS IS 1 HOUR)

	// CHECK IF SESSION VAR TIMEOUT IS SET
	if(isset($_SESSION['timeout'])) {
		
		$duration = time() - (int)$_SESSION['timeout'];		// DURATION EQUALS CURRENT TIME - SESSION TIMEOUT VAR 
		if($duration > $timeout) {							// IF DURATION IS BIGGER THEN VAR TIMEOUT(NOT SESSION VAR) LOG USER OUT AND SEND NOTIF
		    header('Location: logout.php?notif=session_expired');
		}
	}
?>
<!DOCTYPE html >
	<head>
		<!--FontAwesome-->
		<script src="https://use.fontawesome.com/11fc9055ad.js"></script>
	
		<!--Link Tags-->
		<link rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="images/favicon.png">

		<!--Meta Tags-->
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="description" content="Pokemon Pokedex Powered by PokéAPI. Find over 800 pokémon and start your own Pokémon Journey!">
	    <meta name="keywords" content="pokemon, pokedex, pokémon, pokédex, poke, dex, pikachu, bulbasaur, charmander, squirtle, go, pokemon go, pokeapi, restful, api">
	    <meta name="author" content="Stefan Petrović">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    
	    <!--Title Tag-->
	    <title> Pokemon Pokedex </title>
	    
	    <!--JQuery Library-->
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="javascript/waypoints_lib/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="javascript/script_jquery.js"></script>
		<script type="text/javascript" src="javascript/script_jquery_pgnumajax.js"></script>
		<script type="text/javascript" src="javascript/script_jquery_fav_ajax.js"></script>
		<script type="text/javascript" src="javascript/script_jquery_opencard_ajax.js"></script>
		<script type="text/javascript" src="javascript/script_javascript.js"></script>
		<script type="text/javascript" src="javascript/script_login_register.js"></script>
		
		<!-- FB meta tags -->
		<meta property="og:type"          content="website" />
		<meta property="og:url"           content="http://pokedex.petrovicstefan.rs" />
		<meta property="og:title"         content="Pokemon Pokedex" />
		<meta property="og:description"   content="Pokemon Pokedex Powered by PokéAPI. Find over 800 pokémon and start your own Pokémon Journey!" />
		<meta property="og:image"         content="images/preview.png" />

		<!-- Twiter meta tags -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@stefanpetr_dpi" />
		<meta name="twitter:title" content="Pokemon Pokedex" />
		<meta name="twitter:description" content="Pokemon Pokedex Powered by PokéAPI. Find over 800 pokémon and start your own Pokémon Journey!" />
		<meta name="twitter:image" content="images/preview.png" />

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-91751301-1', 'auto');
		  ga('send', 'pageview');
		</script>
		
	</head>
	
	<body>
		<!-- Facebook Button -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<?php 

			if (isset($_REQUEST['rdrpg'])) {
				switch ($_REQUEST['rdrpg']) {
					case 'adminpanel':
						if (isset($_SESSION['id_r']) && $_SESSION['role'] == 'admin') {
								include('adminpanel.php');	
							}
						
						elseif (isset($_SESSION['id_r']) && $_SESSION['role'] == 'user') {
							header('Location: index.php?rdrpg=pokedex');	
						}

						else{
							header('Location:index.php');
						}
						
						break;

					case 'pokedex':
						if (isset($_SESSION['id_r']) && $_SESSION['role'] == 'user') {
								include('userpanel.php');
							}
						
						elseif (isset($_SESSION['id_r']) && $_SESSION['role'] == 'admin') {
							header('Location: index.php?rdrpg=adminpanel');	
						}

						else{
							header('Location:index.php');
						}
						
						break;

					case 'aboutauthor':
						if (isset($_SESSION['id_r']) && $_SESSION['role'] == 'user') {
								include('userpanel.php');
							}
						
						elseif (isset($_SESSION['id_r']) && $_SESSION['role'] == 'admin') {
							header('Location: index.php?rdrpg=adminpanel');	
						}

						else{
							header('Location:index.php');
						}
						
						break;
					
					default:
						if (isset($_SESSION['id_r']) && $_SESSION['role'] == 'user') {
							header('Location: index.php?rdrpg=pokedex');
						}
						
						elseif (isset($_SESSION['id_r']) && $_SESSION['role'] == 'admin') {
							header('Location: index.php?rdrpg=adminpanel');	
						}
						
						else{
							header('Location:index.php');
						}
						break;
				}
			}
			
			else{
				if (isset($_SESSION['id_r']) && $_SESSION['role'] == 'user') {
					header('Location: index.php?rdrpg=pokedex');
				}
						
				elseif (isset($_SESSION['id_r']) && $_SESSION['role'] == 'admin') {
					header('Location: index.php?rdrpg=adminpanel');	// Promeni u adminpanel.php kada napravis
				}
						
				else{
					if (isset($_REQUEST['notif'])) {	// SESSION EXPIRED NOTIFICATION
						if($_REQUEST['notif']=='session_expired'){	
						?>
							<div class="err_notif">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<p>Your session expired! Please Log In again to continue!</p>
								<i class="fa fa-times" aria-hidden="true"></i>
							</div>
						<?php
						}
					}
					include('landingpage.php');
				}
			}
		?>
	</body>
</html>