<?php
session_start();

require_once 'lib/no_cache.php';
require_once 'lib/rdio.php';
require_once 'lib/debug.php';
$currentUser = 0;
require_once('player_auth.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search</title>

<link href="css/search.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="js/search_jump.js"></script> -->
</head>

<body>
<?php

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$query = $_GET["query"];
$search_type = $_GET["type"];
//$other_info = $_GET['other'];

//echo $search_type;
//echo $query;

$rdio = new Rdio(array(CONSUMER_KEY, CONSUMER_SECRET));


//var_dump($search_type != "All");



$resultsTemp = '';

// each call returns results slightly differently
if ($search_type == 'artistalbums') {
	// this is the type that you get when you search directly by artistkey
	
	// this occurs when you click on an artist in the search results
	
	$resultsTemp = $rdio->call('getAlbumsForArtist', array("artist"=>$query));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}
	
	//echo '<pre>';
	//var_dump($resultsTemp);
	//die('crap out');

	$searchResults = $resultsTemp->result;
	
	// fake the $query to the first result
	if ( count($searchResults) != 0 ) {
		$query = $searchResults[0]->artist;
	}
	
} elseif($search_type == "trackKeys"){
	
	$resultsTemp = $rdio->call("get", array("keys"=>$query));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}
	$searchResults = $resultsTemp->result;

}elseif ($search_type != 'all' ) {
	//echo "normal search";
	
	$resultsTemp = $rdio->call("search", array("query"=>$query, "types"=>($search_type), "extras"=>"trackKeys"));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}

	$searchResults = $resultsTemp->result->results;
} elseif ($search_type == "onload") {
	
	$resultsTemp = $rdio->call("getHeavyRotation", array("user" => $currentUser));
	var_dump(resultsTemp);
	
} else {
	//echo "search suggestions";
	
	
	$resultsTemp = $rdio->call("search", array("query" => $query, "types"=>"artist, album, track, playlist", "extras"=>"trackKeys"));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}

	$searchResults = $resultsTemp->result->results;
}




$numresults = count($searchResults);
$i = 1; //result #



echo "<p>($numresults) Results returned for \"" . htmlentities($query) . "\"</p>";
echo "<ol>";

foreach($searchResults as $value) {
	//var_dump($value);
	$type = $value->type;
	$icon = $value->icon;
	
	$explicit = '';
	$length = '';
	$artist = '';
	$artistkey = '';
	$name = '';
	$key = '';
	if ($type == 'p' || $type == 'a'){
		$track_temp = $value->trackKeys;
		$trackKeys = implode(",", $track_temp);
	
	}
	if($type != "r"){
		if ($type != "p"){
			$explicit = @$value->isExplicit; //suppress errors since it may not exist
			$artist = $value->artist;
			$artistkey = $value->artistKey;
		} else {
			$artist = $value->owner;
			$artistkey = $value->ownerKey;
		}
		$key = $value->key;
		$name = $value->name;
		$length = $value->length;
	} else {
		$artist = $value->name;
		$artistkey = $value->key;
	}
	
	// expand the text out from the characters for printing
	switch($type) {
		case 'r':	$type = 'Artist';	break;
		case 't':	$type = 'Song';	break;
		case 'a':	$type = 'Album';	break;
		case 'p':	$type = 'Playlist';	break;
	}
	
	
	
	include('inc/search_results.inc');
	
	
	
	$i++;

}




/*
echo "<pre>";
foreach($process as $array){
	var_dump($array);
}
*/

// echo '<pre>';
// var_dump($searchResults);

//

//foreach($searchResults->result as $value){
	//echo $key . "   " . $value->key . "<br>";
	
	//var_dump($value);
	//echo $value->key;

//}


/*		

<!make explicit red>
*/
?>
</ol>
</body>
</html>
