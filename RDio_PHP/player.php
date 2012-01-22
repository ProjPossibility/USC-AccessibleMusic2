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
var_dump($search_type != "All");
if ($search_type != "All"){
	echo "normal search";
	$searchResults = $rdio->call("search", array("query"=>$query, "types"=>($search_type)));
	$numresults = count($searchResults->result->results);
	$i = 0;
	$process = array();
	foreach($searchResults->result->results as $value){
		$process[i] = array();
		$process[i]["name"] = $value->name;
		$process[i]["type"] = $value->type;
		$process[i]["key"] = $value->key;
		$process[i]["icon"] = $value->icon;
		if(type != "r"){
			if (type != "p"){
				$process[i]["explicit"] = $value->explicit;
			} else {
				$process[i]["artist"] = $value->owner;
				$process[i]["artistKey"] = $value->ownerKey;
			}
			$process[i]["length"] = $value->length;
			$process[i]["artist"] = $value->artist;
			$process[i]["artistKey"] = $value->artistKey;
		}
		i++;
	}
} else {
	echo "search suggestions";
	$searchResults = $rdio->call("searchSuggestions", array("query" => $query));
	$numresults = count($searchResults->result);
}
echo "<pre>";
foreach($process as $array){
	var_dump($array);
}

if ($searchResults->status != "ok") {
	die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
}

// echo '<pre>';
// var_dump($searchResults);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search</title>

<link href="search.css" rel="stylesheet" type="text/css" />
</head>

<body>
xx Results returned for "abcdefghijklnoqprstuvwxyz"

<div id="results">
<div id="resultnum">Num.</div>
<div id="album"><img src="alcover.jpg" width="150" height="150" alt="Album cover" /></div>
<div id="type">Type</div>
<div id="songName">Song Name</div>
<div id="artistName">Artist Name</div>
<div id="explicit">Explicit</div>
<div id="length">Length</div>
<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
<div id="results">
<div id="resultnum">Num.</div>
<div id="album"><img src="alcover.jpg" width="150" height="150" alt="Album cover" /></div>
<div id="type">Type</div>
<div id="songName">Song Name</div>
<div id="artistName">Artist Name</div>
<div id="explicit">Explicit</div>
<div id="length">Length</div>
<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
<div id="results">
<div id="resultnum">Num.</div>
<div id="album"><img src="alcover.jpg" width="150" height="150" alt="Album cover" /></div>
<div id="type">Type</div>
<div id="songName">Song Name</div>
<div id="artistName">Artist Name</div>
<div id="explicit">Explicit</div>
<div id="length">Length</div>
<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
<div id="results">
<div id="resultnum">Num.</div>
<div id="album"><img src="alcover.jpg" width="150" height="150" alt="Album cover" /></div>
<div id="type">Type</div>
<div id="songName">Song Name</div>
<div id="artistName">Artist Name</div>
<div id="explicit">Explicit</div>
<div id="length">Length</div>
<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
<div id="results">
<div id="resultnum">Num.</div>
<div id="album"><img src="alcover.jpg" width="150" height="150" alt="Album cover" /></div>
<div id="type">Type</div>
<div id="songName">Song Name</div>
<div id="artistName">Artist Name</div>
<div id="explicit">Explicit</div>
<div id="length">Length</div>
<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
</body>
</html>


//echo "($numresults) Results returned for \"" . htmlentities($query) . "\"";

//foreach($searchResults->result as $value){
	//echo $key . "   " . $value->key . "<br>";
	
	//var_dump($value);
	//echo $value->key;
?>
	<img src="<?//php echo $value->icon;?>">
	<?//php echo $value->key; ?>
	<?//php echo $value->type; ?>
	<?//php echo $value->artist; ?>
	<?//php echo $value->name; ?>
	<?//php echo $value->isExplicit; ?>
	<?//php echo $value->length; ?>
<?
//}

?>
