$(document).ready(function () {
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
            getFavourites();
        }
    }).fail(function(){
                    getFavourites();
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

    ///////////////////// FUNCTION THAT GETS FAVOURITED POKEMON DATA ///////////////////////
    var resulCount=0;
    var pokeCounter=0;
    function getFavourites(){
        $.ajax({
            type: 'POST',
            url: 'favourites.php',
            dataType: 'json',
            success: function (favpageresp){
                resulCount = favpageresp.length;
                pctload=100/(resulCount*2);
                if (favpageresp == "empty") {
                    //////////////////////////// CHECKS IF FAVOURITES ARE EMPTY AND ADDS BACKGROUND MESSAGE /////////////
                    if( !$.trim( $('.card-wrapper').html() ).length ) {
                        $('.card-wrapper').append("<div class='empty_fav'><img src='images/empty_poke.png'><span>Nothing to see here.</span><span>To add pokémon to favourites go to pokédex page and click <3 on pokémon you wish to add.</span></div>");
                    }
                    
                    $('.loadbar-bar').css('width', '100%');
                    $('#ajax_loader').delay(1000).fadeOut();
                }
                else{

                    $.each(favpageresp, function(key, value){
                        pokeurl=value;
                        
                        $.getJSON(pokeurl, function(pokepodaci){
                            $.ajax({
                                type: 'POST',
                                url: 'pokupipokemone.php',
                                data: {val : JSON.stringify(pokepodaci), pgid : "favourites"},
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
                        }).fail(function(){
                                $('.loader-note').html("Ooops! We couldn't find your pokémon! Please try again later.");
                            });
                    });
                }
            }
        });
    }

    ////////////////////////////////////// FUNCTION THAT FILLS POKEMON DESCRIPTIONS /////////

    var descCounter = 0;
    function fillDescriptions(){
        $('.poke-card').each(function(){
            pokID = $(this).attr('data-id');
            descUrl="https://pokeapi.co/api/v2/pokemon-species/"+pokID;
            pctload=100/(resulCount*2);
            var pokeDesc;
            $.getJSON(descUrl, function(descpodaci){
                descCounter++;
                pokeDesc=descpodaci.flavor_text_entries[1].flavor_text;
                pokeDescId=descpodaci.id;
                $("[data-id='" + pokeDescId + "']").find('.poke-desc').html(pokeDesc);
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
    
})