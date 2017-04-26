
$(document).ready(function(){ 
	

	/////////////////////////////////// REGISTRATION VALIDATION ////////////////

	$('#btn_register').click(function(e){
		var greske="";
		if ($('#regname').val().length<5) {
			//e.preventDefault();
			greske+="Your Username has to be at least 5 characters long.</br>";
		}

		if ($('#regpass').val().length<5) {
			//e.preventDefault();
			greske+="Your Password has to be at least 5 characters long.</br>";
		}

		if ($("#regpass").val()!==$("#reregpass").val()) {
			
			greske+="Passwords do not match!</br>";
		}

		if (greske.length!=0) {
			e.preventDefault();
			$(".registration-notif_wrapper").css('display', 'flex');
			$('.notif-text').html(greske);
		}
		else{
			e.preventDefault();
			$.ajax({
				type: 'POST',
	            url: 'register.php',
	            data: {
	            	regname : $('#regname').val(),
	            	regpass : $('#regpass').val(),
	            	reregpass : $("#reregpass").val()
	        	},
	            dataType: 'text',
	            success: function (resp){

	            	$(".registration-notif_wrapper").css('display', 'flex');
					$('.notif-text').html(resp);
	            }
			});
		}
	});

	////////////////////////// LOG IN VALIDATION ///////////////////////////////////

	$('#btn_login').click(function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
            url: 'login.php',
            data: {
            	logname : $('#name').val(),
            	logpass : $('#pass').val()
        	},
            dataType: 'text',
            success: function (resp){
            	if (resp=="success") {
            		window.location.reload();
            	}
            	else{
            		$(".registration-notif_wrapper").css('display', 'flex');
					$('.notif-text').html(resp);
					$('.button.login button').removeClass("active");
					$('.button.login .click-efect').remove();
            	}
            	
            }
		});
	});

	////////////////////////// PRELOADER ///////////////////////////////////////////

	/*$('.preloader__container').hide();*/
	// Use above to disable preloader for fast testing! //

	$(window).on('load', function() { // Kada je cela stranica ucitana 
	  $('.preloader__items').delay(1500).fadeOut(); // Prvo nestaje animacija
	  $('.preloader__container').delay(1850).fadeOut('slow'); // Na kraju nestaje div koji pokriva stranu
	})

	////////////////////////// SMOOTH SCROLLING SECTIONS ///////////////////////////
	
	$("#backtotop").hide();
	$(function() {
		  $('a[href*="#"]:not([href="#"])').click(function() {
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		      var target = $(this.hash);
		      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		      if (target.length) {
		        $('html, body').animate({
		          scrollTop: target.offset().top
		        }, 1000);
		        return false;
		      }
		    }
		  });
		});

	////////////////////////// SHOWING AND HIDING LOGIN FORM ///////////////////////

	$("#login_btn").click(function(){
		$(".container").fadeOut(function(){
			$("#particle-canvas").fadeOut();
			$("#login_form").fadeIn().css({"display": "block"});
		});
	});

	$(".login_form_bg").click(function(){
		$("#login_form").fadeOut(function(){
			$(".container").fadeIn();
			$("#particle-canvas").fadeIn();
		});
	})

	////////////////////////// HIDING REGISTRATION NOTIFICATION ////////////////////

	$(".registration-notif_wrapper .exit-notif").click(function(){
		$(".registration-notif_wrapper").fadeOut();
	})

	/////////////////////////// Waypoint.JS /////////////////////////////////////////

	// SHOWING TO TOP BUTTON AFTER SCROLLING TO BOTTOM
	
	$('#infoscreen3').waypoint({
	  handler: function() {
	    $("#backtotop").slideDown("fast");
	  }
	})

	// HIDING TO TOP BUTTON AFTER SCROLING TO TOP

	$('#infoscreen3').waypoint({
	  handler: function() {
	    $("#backtotop").slideUp("fast")
	  },
	  offset: '30%'
	})
	

	/////////////////////////// TO TOP BUTTON HOVER //////////////////////////////////

	$( "#backtotop" )
		.on( "mouseenter", function() {
    		$( ".fa-chevron-up, .btt" ).css({
		      	"color": "white",
		      	"-webkit-transition": "color 500ms ease-in",
  			  	"-moz-transition": "color 500ms ease-in",
  				"-o-transition": "color 500ms ease-in",
  				"transition": "color 500ms ease-in"
		    });
  		})
		.on( "mouseleave", function() {
		    $( ".fa-chevron-up, .btt" ).css({
		      	"color": "black"
		    });
		});
	
	//////////////////////////// ADMIN PANEL ERROR NOTIF EXIT /////////////////////////

	$(document).on('click','.err_notif .fa-times', function(){
		$(this).parent().slideUp();
	})

})


