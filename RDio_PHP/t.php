<?php
//phpinfo();


session_start(); 
require_once("lib/rdio.php");


// get the token needed to make the calls to the API

define('CONSUMER_KEY', 'xyu4k4p2r48p3pec6z8fsupa');
define('CONSUMER_SECRET', 'pYvb45Xd5D');

$rdio = new Rdio(CONSUMER_KEY, CONSUMER_SECRET);

//echo $rdio->call('getPlaybackToken', 
?>
