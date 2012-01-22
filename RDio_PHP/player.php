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
} else {
	echo "search suggestions";
	$searchResults = $rdio->call("searchSuggestions", array("query" => $query));
}


if ($searchResults->status != "ok") {
	die ("Server Error: Search Results are not available at this time. -- " . $searchResults->status);
}

echo '<pre>';
var_dump($searchResults);


$numresults = count($searchResults->result);
echo "($numresults) Results returned for \"" . htmlentities($query) . "\"";

foreach($searchResults->result as $value){
	//echo $key . "   " . $value->key . "<br>";
	
	var_dump($value);
	//echo $value->key;
?>
	<img src="<?php echo $value->icon;?>">
	<?php echo $value->key; ?>
	<?php echo $value->type; ?>
	<?php echo $value->artist; ?>
	<?php echo $value->name; ?>
	<?php echo $value->isExplicit; ?>
	<?php echo $value->length; ?>
<?
}

?>
