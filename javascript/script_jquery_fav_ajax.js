/////////////////////////////// ADD TO FAVOURITES //////////////////////////////////////////
function addToFavourites(fName,fId){
    //alert("Pokrenut add to fav: "+fName+" / "+fId);
    
    $.ajax({
		type: 'POST',
        url: 'addtofavourites.php',
        data: {fName : fName, fId : fId},
        dataType: 'text',
        success: function (favresp){
        	if (favresp=='success') {
        		$("[data-id='" + fId + "']").find('#favIcon').removeClass('fa-heart-o');
        		$("[data-id='" + fId + "']").find('#favIcon').addClass('fa-heart');
                $("[data-id='" + fId + "']").find('.btn_fav').attr("onclick","removeFromFavourites('"+fName+"',"+fId+")");

                $(".bigcard_card[card-id='" + fId + "']").find('#favIcon').removeClass('fa-heart-o');
                $(".bigcard_card[card-id='" + fId + "']").find('#favIcon').addClass('fa-heart');
                $(".bigcard_card[card-id='" + fId + "']").find('.btn_fav').attr("onclick","removeFromFavourites('"+fName+"',"+fId+")");
        	}
            else if (favresp=='exists'){
                alert('Looks like you already caught this pokémon!');
            }
        	else {
        		alert('This pokémon escaped our Database Query! Please try again later.');
        	}
        }
	});
  }
/////////////////////////////// REMOVE FROM FAVOURITES //////////////////////////////////////////  
function removeFromFavourites(fName,fId){
    //alert("Pokrenut add to fav: "+fName+" / "+fId);
    
    $.ajax({
		type: 'POST',
        url: 'removefromfavourites.php',
        data: {fName : fName, fId : fId},
        dataType: 'text',
        success: function (favremresp){
        	if (favremresp=='success') {
        		$("[data-id='" + fId + "']").find('#favIcon').removeClass('fa-heart');
                $("[data-id='" + fId + "']").find('#favIcon').addClass('fa-heart-o');
                $("[data-id='" + fId + "']").find('.btn_fav').attr("onclick","addToFavourites('"+fName+"',"+fId+")");

                $(".bigcard_card[card-id='" + fId + "']").find('#favIcon').removeClass('fa-heart');
                $(".bigcard_card[card-id='" + fId + "']").find('#favIcon').addClass('fa-heart-o');
                $(".bigcard_card[card-id='" + fId + "']").find('.btn_fav').attr("onclick","addToFavourites('"+fName+"',"+fId+")");

        		$(".in_fav[data-id='" + fId + "']").fadeOut( 1000, function() {
                                                        $( this ).remove();
                                                        //////////////////////////// CHECKS IF FAVOURITES ARE EMPTY AND ADDS BACKGROUND MESSAGE /////////////
                                                        if( !$.trim( $('.card-wrapper').html() ).length ) {
                                                            $('.card-wrapper').append("<div class='empty_fav'><img src='images/empty_poke.png'><span>Nothing to see here.</span><span>To add pokémon to favourites go to pokédex page and click <3 on pokémon you wish to add.</span></div>");
                                                        }
                                                    });

        	}
        	else {
        		alert("Looks like this pokémon doesn't want to leave you! Try to release it again later.");
        	}
        }
	});
  }


    