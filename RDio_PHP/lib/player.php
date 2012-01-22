<?php
session_start();

require_once 'rdio.php';
require_once 'lib/debug.php'

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$rdio = new Rdio(array(CONSUMER_KEY, CONSUMER_SECRET));
$searchResults = $rdio->call("searchSuggestions", array("query" => "pumped up kicks"));
foreach($searchResults->$result as $key => $value){
	echo $key . '\t' . $value->key . '\n';
}

?>