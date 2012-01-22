var phpURL = "search.php";
var ajax_load = "<img src='img/load.gif' alt='loading...' />";
$('#searchsuggest').html(ajax_load).load(phpURL, "query=" + $('#query').val() + "&type=" + "onload");
