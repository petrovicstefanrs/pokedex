$(document).ready(function () {

	///////////////////// MANGE CLICKING ON POKE CARDS //////////////////////////////////////////
	
	$(document).on("click",".open_card", function() {
        
		klikId = $(this).parent('.poke-card').attr('data-id');
        klikDesc = $(this).parent('.poke-card').find('.poke-desc').text();
        $('#card_loader').css("display", "flex").hide().fadeIn();
        $('.card-container').fadeOut(500);
        $('.pagination-wrapper').fadeOut(500);
        
        //////////////////////////// RANDOM GRADIENT ON  POKECARDS /////////////////////////////

        var pcbg = [];

		$.ajax({
			type: 'POST',
	        url: 'getbgs.php',
	        dataType: 'json',
	        success: function (bgresp){
	        	pcbg = bgresp;
	        	$('.loadbar-bar-card').css('width', '+='+pctload+"%");
	        	getPokemonData();
	        }
		}).fail(function(){
						getPokemonData();
					});


		function dynamicCardBG(){ 
			
			$(function(){

				$('.bigcard_card').each(function(){
					var randomBg = Math.floor(Math.random() * pcbg.length);
					$(this).find('.bigcard_right_img').css('background', pcbg[randomBg]);
					$(this).find('.bigcard_right_img').css('background-size', 'cover');
					$(this).find('.bigcard_stat_val').css('background', pcbg[randomBg]);
				});
			});
		}

		////////////////////////////////////// FUNCTION THAT FILLS OTHER POKEMON DATA /////////

		var descCounter = 0;
		function fillData(){
			$('.bigcard_card').each(function(){
				//pokID = $(this).attr('card-id');
				descUrl="http://pokeapi.co/api/v2/pokemon-species/"+klikId;
				$.getJSON(descUrl, function(descpodaci){
					$.ajax({
						type: 'POST',
			            url: 'bigcardotherdata.php',
			            data: {dataval : JSON.stringify(descpodaci)},
			            dataType: 'text',
			            success: function (dataresp){
			            	$('.other_stats').html(dataresp);
			            	$('.loadbar-bar-card').css('width', '+='+pctload+"%");
			            	descCounter++;
			            	if (descCounter==1) {
			            		dynamicCardBG();
								$('#card_loader').delay(1000).fadeOut();
							}

							////////////////// EXITING TH BIG CARD ////////////////////////////////////////////
							/*
							$('.btn_exit').on("click", function() {
								$('.bigcard_wrapper').fadeOut(500);
								$('.card-container').fadeIn(500);
							    $('.pagination-wrapper').fadeIn(500);
								$('.bigcard_wrapper').remove();
							}); */
	        			
			            }
					});
				}).fail(function(){
						dynamicCardBG();
						$('#card_loader').delay(1000).fadeOut();
					});


			});
		}

        ////////////////////// FUNCTION THAT GETS POKEMON DATA FROM API //////////////////////////

        var pokeCounter = 0;
		var pokeurl="http://pokeapi.co/api/v2/pokemon/"+klikId;
		var pctload=100/3;
		function getPokemonData(){
			$.getJSON(pokeurl, function(pokepodaci){
				$.ajax({
					type: 'POST',
		            url: 'bigcard.php',
		            data: {val : JSON.stringify(pokepodaci), pokeDesc : klikDesc},
		            dataType: 'text',
		            success: function (resp){
		            	$('.searchbar_container').hide();
		            	$('.card-container').after(resp);
		            	pokeCounter++;
		            	$('.loadbar-bar-card').css('width', '+='+pctload+"%");
		            	if (pokeCounter==1) {

					    	//dynamicCardBG();
					    	fillData();
						}

						////////////////// EXITING THe BIG CARD ////////////////////////////////////////////
						
						$('.btn_exit').on("click", function() {
							$('.bigcard_wrapper').fadeOut(500);
							$('.card-container').fadeIn(500);
						    $('.pagination-wrapper').fadeIn(500);
							$('.bigcard_wrapper').remove();
							$('.loadbar-bar-card').css('width', 0);
							$('.searchbar_container').show();
						});
        			
		            }
				});
			}).fail(function(jqXHR) {
			    if (jqXHR.status == 404) {
			        $('.loader-note').html("404 Ooops! We couldn't find data about this pokémon</br>Please try again later!");
			    }
			    if (jqXHR.status == 429) {
			    	$('.loader-note').html("Ooops! Looks like you hit your daily limit. </br>Please come back tomorow. <3");
			    }
			    else {
			    	$('.loader-note').html("Ooops! Something went wrong. Please try again later.");
			    }
			});
		}
		//getPokemonData();
    }); 
	

	$(document).on("mouseenter",".bigcard_info_button", function() {
		$(this).find(".bigcard_info_panel").css("display", "flex").hide().delay( 1000 ).fadeIn(500);

	}).on("mouseleave",".bigcard_info_button",function() {
		$(this).find(".bigcard_info_panel").fadeOut(100);
	});
})