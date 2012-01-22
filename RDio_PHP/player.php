<?php
session_start();

require_once 'lib/rdio.php';
require_once 'lib/debug.php';

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$query = $_GET["query"];
$search_type = $_GET["type"];
echo $search_type;
//echo $query;
$rdio = new Rdio(array(CONSUMER_KEY, CONSUMER_SECRET));


//var_dump($search_type != "All");



$resultsTemp = '';

if ($search_type != "All"){
	echo "normal search";
	
	
	$resultsTemp = $rdio->call("search", array("query"=>$query, "types"=>($search_type)));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}
	
	echo '<pre>';
	var_dump($resultsTemp);
	die('crap out');

	$searchResults = $resultsTemp->result->results;
} else {
	echo "search suggestions";
	
	
	$resultsTemp = $rdio->call("searchSuggestions", array("query" => $query));
	if ($resultsTemp->status != "ok") {
		die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
	}

	$searchResults = $resultsTemp->result;
}	




$numresults = count($searchResults);
$i = 1; //result #



echo "($numresults) Results returned for \"" . htmlentities($query) . "\"";

foreach($searchResults as $value) {
	$name = $value->name;
	$type = $value->type;
	$key = $value->key;
	$icon = $value->icon;
	
	$explicit = '';
	$length = '';
	$artist = '';
	$artistkey = '';

	if($type != "r"){
		if ($type != "p"){
			$explicit = $value->isExplicit;
			$artist = $value->artist;
			$artistkey = $value->artistKey;
		} else {
			$artist = $value->owner;
			$artistkey = $value->ownerKey;
		}
		$length = $value->length;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search</title>

<!link href="search.css" rel="stylesheet" type="text/css" />
</head>

<body>

<!make explicit red>
</body>
</html>
*/
?>
