<?php
session_start();

require_once 'rdio.php';

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$rdio = new Rdio(array(CONSUMER_KEY, CONSUMER_SECRET));
$searchResults = $rdio->call("searchSuggestions", array("query" => "pumped up kicks"));
var_dump($searchResults);

?>