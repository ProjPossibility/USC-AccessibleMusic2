function search_play( key ) {
	//alert(document.title);
	var search_field = document.getElementById('play_key');
	//alert(search_field.value);
	search_field.value = key;
	var play_button = document.getElementById('play');
	var stop_button = document.getElementById('stop');
	//alert(play_button);
	play_button.click();
	stop_button.click();
}
