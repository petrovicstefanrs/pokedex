$(document).ready(function() {

	/////////////////// AJAX THAT GETS AND SETS SESSION VAR FOR MAX PG NUMBER //////////////////

	var api = "http://pokeapi.co/"
	var apimaxpgurl=api+"api/v2/pokemon/";
	function getMaxPg(){

		$.getJSON(apimaxpgurl, function(maxpgpodatak){

			var maxpgresul=Math.ceil(maxpgpodatak.count/20);
			console.log(maxpgresul);
			$.ajax({
				type: 'POST',
	            url: 'pokupipokemaxpg.php',
	            data: {maxpgval : maxpgresul}
			});
		});
	}
	
	getMaxPg();

})