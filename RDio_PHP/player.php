<?php
session_start();

require_once 'lib/rdio.php';
require_once 'lib/debug.php';

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$query = $_GET["query"];
echo $query;
$rdio = new Rdio(array(CONSUMER_KEY, CONSUMER_SECRET));
$searchResults = $rdio->call("searchSuggestions", array("query" => $query));

foreach($searchResults->result as $key => $value){
	echo $key . "   " . $value->key . "<br>";
}

?>