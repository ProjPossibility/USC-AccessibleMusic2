function search_play( key ) {
	//alert(document.title);
	var search_field = document.getElementById('play_key');
	//alert(search_field.value);
	search_field.value = key;
	var searchsuggest = $('#searchsuggest');
	var play_button = $('#play');
	var stop_button = $('#stop');
	//alert(play_button);
	play_button.click();
	stop_button.click();
}


function search_albums ( key ) {
	//getAlbumsForArtist
	var phpURL = "search.php";
	var ajax_load = "<img src='img/load.gif' alt='loading...' />";
	$('#searchsuggest').html(ajax_load).load(phpURL, "query=" + key + "&type=artistalbums");
}

function search_songs( key ){
	//Search songs for an album or a playlist
}