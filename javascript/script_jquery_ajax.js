$(document).ready(function() {
	
	/////////////////////////// AJAX LOADER ////////////////////////////////////////

	$('#ajax_loader').css('display', 'flex');
	
	//////////////////////////// RANDOM GRADIENT ON  POKECARDS /////////////////////////////

	var pcbg = [];

	$.ajax({
		type: 'POST',
        url: 'getbgs.php',
        dataType: 'json',
        success: function (bgresp){
        	pcbg = bgresp;
        	getPokemonData();
        }
	}).fail(function(){
					getPokemonData();
				});


	function dynamicBG(){ 
		
		$(function(){

			$('.poke-card').each(function(){
				var randomBg = Math.floor(Math.random() * pcbg.length);
				$(this).find('.sprite-bg').css('background', pcbg[randomBg]);
				$(this).find('.sprite-bg').css('background-size', 'cover');
				$(this).find('.content-bg').css('background', pcbg[randomBg]);
			});
		});
	}

	////////////////////////////////////// FUNCTION THAT FILLS POKEMON DESCRIPTIONS /////////

	var descCounter = 0;
	function fillDescriptions(){
		$('.poke-card').each(function(){
			pokID = $(this).attr('data-id');
			descUrl=api+"api/v2/pokemon-species/"+pokID;
			var pctload=100/(resulCount*2);
			var pokeDesc;
			$.getJSON(descUrl, function(descpodaci){
				descCounter++;
				pokeDesc=descpodaci.flavor_text_entries[1].flavor_text;
				pokeDescId=descpodaci.id;
				$("[data-id='" + pokeDescId + "']").find('.poke-desc').html(pokeDesc);
				//console.log("pokID="+pokeDescId+" Desc="+pokeDesc);
				$('.loadbar-bar').css('width', '+='+pctload+"%");
				if(descCounter==resulCount){
					$('#ajax_loader').delay(1000).fadeOut();

				}
			}).fail(function(){
					$('.loadbar-bar').css('width', '100%');
					$('#ajax_loader').delay(1000).fadeOut();
					console.log("Description not found!");
				});

		});
	}

	////////////////////// FUNCTION THAT GETS POKEMON DATA FROM API //////////////////////////

	var pokeCounter=0;
	var api = "https://pokeapi.co/"
	var apiurl=api+"api/v2/pokemon/"+urloffset;
	var resulCount = 0;
	function getPokemonData(){

		
		$.getJSON(apiurl, function(podaci){

			var resul=podaci.results;
			resulCount=resul.length;
			var pctload=100/(resulCount*2);
			//console.log("Broj resultata "+resulCount);
				$.each(resul, function(key, value){
				pokeurl=value.url;
				//console.log(pokeurl);
				$.getJSON(pokeurl, function(pokepodaci){
					$.ajax({
						type: 'POST',
			            url: 'pokupipokemone.php',
			            data: {val : JSON.stringify(pokepodaci), pgid : "pokedex"},
			            dataType: 'text',
			            success: function (resp){

			            	$('.card-wrapper').append(resp);
			            	pokeCounter++;
			            	//console.log(pokeCounter);
			            	$('.loadbar-bar').css('width', '+='+pctload+"%");

			            	if (pokeCounter==resulCount) {
								//$('#ajax_loader').delay(1000).fadeOut();

								//console.log('Uradio sve');
						    	dynamicBG();
						    	fillDescriptions();
							}
			            }
					});
				});
			});
		}).fail(function(jqXHR) {
		    if (jqXHR.status == 404) {
		        $('.loader-note').html("404 Ooops! We couldn't find any pokémon this time</br>Please try again later!");
		    }
		    else if (jqXHR.status == 429) {
		    	$('.loader-note').html("Ooops! Looks like you hit your daily limit. </br>Please come back tomorow. <3");
		    }
		    else {
		    	$('.loader-note').html("Ooops! Something went wrong. Please try again later.");
		    }
		});
	}

	//////////////////////////// SEARCH BAR HANDLERS //////////////////////////////////
	
	// CANCEL SEARCH RESULTS AND GO BACK TO POKEDEX //
	$(document).on("click",".backtodex", function() {
		if ($('.card-wrapper').css('display')=='none'){
    		$('.search-wrapper').hide();
    		$('.card-wrapper').fadeIn(500);
    		$('.pagination-wrapper').fadeIn(500);
    	}
	});

	$(document).on("click",".search_icon", function() {							// CLICKING ON SEARCH ICON
		$(this).parent().find('.searchnamefield').toggleClass('active');		// ACTIVATES SEARCH BAR

		// CANCEL SEARCH RESULTS AND GO BACK TO POKEDEX //
		$(this).parent().find('.searchnamefield').keyup(function(e){
			if(e.which==8){
				if ($('.card-wrapper').css('display')=='none'){
		    		$('.search-wrapper').hide();
		    		$('.card-wrapper').fadeIn(500);
		    		$('.pagination-wrapper').fadeIn(500);
		    	}
			}
		});

		// IF ENTER IS PRESSED START SEARCH //
		$(this).parent().find('.searchnamefield').keypress(function (e) {
			if (e.which == 13) {																// ENTER PRESSED
			    var pokename=$(this).parent().find('.searchnamefield').val().toLowerCase();
			    //alert(pokename);
			    if (pokename=="") {																// IF STRING EMPTY CANCEL SEARCH RESULTS OR DONT DO ANYTHING
			    	if ($('.card-wrapper').css('display')=='none'){
			    		$('.search-wrapper').hide();
			    		$('.card-wrapper').fadeIn(500);
			    		$('.pagination-wrapper').fadeIn(500);
			    	}
			    }
			    else{
			    	$('#search_loader').css('display', 'flex');									// ELSE SHOW LOADER AND LOAD POKECARD
			    	searchpokeCounter = 0;
			    	var searchurl = "https://pokeapi.co/api/v2/pokemon/"+pokename;
			    	$.getJSON(searchurl, function(searchpodaci){								// BASIC DATA FIRST AJAX CALL
						$.ajax({
							type: 'POST',
				            url: 'pokupipokemone.php',
				            data: {val : JSON.stringify(searchpodaci), pgid : "search"},
				            dataType: 'text',
				            success: function (resp){
				            	$('.search-wrapper').html(resp);
				            	searchpokeCounter++;
				            	//$('.loadbar-bar').css('width', '+='+pctload+"%");

				            	if (searchpokeCounter==1) {
									//$('#ajax_loader').delay(1000).fadeOut();
							    	// GET DYNAMIC BG FOR SEARCH RESULT

							    	$('.search-wrapper .poke-card').each(function(){						// ADD DYNAMIC BG
										var randomBg = Math.floor(Math.random() * pcbg.length);
										$(this).find('.sprite-bg').css('background', pcbg[randomBg]);
										$(this).find('.sprite-bg').css('background-size', 'cover');
										$(this).find('.content-bg').css('background', pcbg[randomBg]);

										$('.search-wrapper .backtodex').css('background', pcbg[randomBg]);
										$('.search-wrapper .backtodex').css('background-size', 'cover');
									});
									


							    	// GET SEARCH RESULT POKE DESCRIPTION

							    	searchID = $('.search-wrapper .poke-card').attr('data-id');
									searchdescUrl="https://pokeapi.co/api/v2/pokemon-species/"+searchID;
									var pokeDesc;
									$.getJSON(searchdescUrl, function(searchdescpodaci){
										pokeDesc=searchdescpodaci.flavor_text_entries[1].flavor_text;
										pokeDescId=searchdescpodaci.id;
										$(".search-wrapper .poke-card[data-id='" + pokeDescId + "']").find('.poke-desc').html(pokeDesc);
										$('.card-wrapper').hide();
										$('.pagination-wrapper').hide();
										$('.search-wrapper').css("display", "flex").hide().fadeIn(500);
										$('#search_loader').delay(1000).fadeOut();
									}).fail(function(){
											//console.log("Description not found!");
											$('.card-wrapper').hide();
											$('.pagination-wrapper').hide();
											$('.search-wrapper').css("display", "flex").hide().fadeIn(500);
											$('#search_loader').delay(1000).fadeOut();
										});
								}
				            }
						});
					}).fail(function(jqXHR) {				// ON ERROR SHOW MESSAGE
					    if (jqXHR.status == 404) {
					        $('.search-wrapper').html("<div class='empty_fav'><img src='images/empty_poke.png'><span>Nothing to see here.</span><span>There is no pokémon with that name.</span></div>");
					        $('.card-wrapper').hide();
							$('.pagination-wrapper').hide();
							$('.search-wrapper').css("display", "flex").hide().fadeIn(500);
							$('#search_loader').delay(1000).fadeOut();
					    }
					    else if (jqXHR.status == 429) {
					    	$('.search-wrapper').html("<div class='empty_fav'><img src='images/empty_poke.png'><span>Ooops! Looks like you hit your daily limit.</span><span>Please come back tomorow. <3</span></div>");
					    	$('.card-wrapper').hide();
							$('.pagination-wrapper').hide();
							$('.search-wrapper').css("display", "flex").hide().fadeIn(500);
							$('#search_loader').delay(1000).fadeOut();
					    }
					    else {
					    	$('.search-wrapper').html("<div class='empty_fav'><img src='images/empty_poke.png'><span>Ooops! Something went wrong.</span><span>Please try again later.</span></div>");
					    	$('.card-wrapper').hide();
							$('.pagination-wrapper').hide();
							$('.search-wrapper').css("display", "flex").hide().fadeIn(500);
							$('#search_loader').delay(1000).fadeOut();
					    }

					    $('#search_loader').delay(1000).fadeOut();
					});
			    }
			}
		});
	});

})

