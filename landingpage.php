
		<!--Preloader Animation-->

		<div class="preloader__container">
			
			<div class="preloader__items">
				<div class="preloader__animation"></div>
				<div class="preloader__note"><p>Please wait while we catch some pokémon for you!</p></div>
			</div>

			<div class="preloader__credits"><p>Animated By: <a href="https://dribbble.com/shilly">Michael Shillingburg</a></p></div>
		</div>

		<!--Login Form-->
		
		<div id="login_form">
		<?php
			include('loginform.php');
		?>
			<div class="login_form_bg"></div>
		</div>

		<section id="overlay">
			<div id="login_btn"><p>LOG IN</p></div> 
		</section>

		<!--Registration Notif-->

		<div class="registration-notif_wrapper">
			<div class="reg_notif_card">
				<div class="exit-notif"><i class="fa fa-times" aria-hidden="true"></i></div>
				<span class="notif-text"></span>
			</div>
		</div>
		
		<!--Back to Top-->

		<a href="#heroheader">
		<div id="backtotop">
			<span id="backtohero"><i class="fa fa-chevron-up" aria-hidden="true"></i></br><span class="btt">TO TOP</span></span>
		</div>
		</a>

		<!--Hero Header-->

		<section id="heroheader">
			
			<div id="particle-canvas"></div>

			<div id="main" class="container">
	  			<div class="image">
	  				<img id="pokemonlogo" class="plogo" src="images/poklogo.png" alt="Pokemon Pokedex Logo"/>
	  			</div>
	  			<span class="age_info"><p>You have to be at least <strong>10<span class="age_info_sub">yrs</span> old</strong><br/>to start your Pokémon journey!</p></span>
	  			<!-- <span id="login_btn"><p>LOG IN</p></span> -->

	  			<a class="arrowlink" href="#infoscreen"><div class="arrow bounce"></div></a>
			</div>
			
			<div id="background" class="bg"></div>
		
		<!--Particle effect script-->

			<script type="text/javascript" src="javascript/script_particleeffect.js"></script>
		</section>

		<!--Introduction Screen-->
		
		<section id="infoscreen_container">

		<div id="infoscreen">
			<div class="info__container pokemon__section">
			    <div class="info__item info__item--left">
				    <div class="info__content">
				    	<p class="text__up">Access over 800+</p>
				        <h1 class="text__mid">Pokémon</h1>
				        <h2 class="text__down">We use pokeapi to enable you to access over 800 pokémon from all generations and regions. Every pokémon has all sort of stats!</h2>
				    </div>
				    <p class="text__background">POKÉMON</p>
			    </div>

			    <div class="info__item info__item--right"></div>

			    <img class="pokemon__img pikachu__img" src="images/pikachu.png" alt="Pikachu Sprite" />

			    <a class="arrowlink" href="#heroheader"><div class="arrow180 bounce180"></div></a>
			    <a class="arrowlink" href="#infoscreen2"><div class="arrow bounce"></div></a>
			</div>
			
		</div>
		
		<div id="infoscreen2">
			<div class="info__container regions__section">
			    <div class="info__item info__item--left">
				    <div class="info__content">
				    	<p class="text__up">Search by</p>
				        <h1 class="text__mid">Regions</h1>
				        <h2 class="text__down">All pokémon are categorised by region so you can access the list of all the pokemon in a specific region!</h2>
				    </div>
				    <p class="text__background">REGIONS</p>
			    </div>

			    <div class="info__item info__item--right"></div>

			    <img class="pokemon__img regions__map" src="images/map.png" alt="Pokemon Map Image" />

			    <a class="arrowlink" href="#infoscreen"><div class="arrow180 bounce180"></div></a>
			    <a class="arrowlink" href="#infoscreen3"><div class="arrow bounce"></div></a>
			</div>

		</div>

		<div id="infoscreen3">
			<div class="info__container fav__section">
			    <div class="info__item info__item--left">
				    <div class="info__content">
				    	<p class="text__up">Put all pokémon you love in</p>
				        <h1 class="text__mid">Favourites</h1>
				        <h2 class="text__down">All the pokémon you love in one place. Put then in favourites and access them any time!</h2>
				    </div>
				    <p class="text__background">FAVOURITES</p>
			    </div>

			    <div class="info__item info__item--right"></div>

			    <img class="pokemon__img fav__heart" src="images/heart.png" alt="Pokemon Heart Image" />

			    <a class="arrowlink" href="#infoscreen2"><div class="arrow180 bounce180"></div></a>
			</div>

		</div>
		</section>