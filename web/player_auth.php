<?php

include_once('lib/debug.php');
include_once('lib/no_cache.php');


session_start();

require_once 'lib/rdio.php';
require_once 'lib/rdio-credentials.php';


# create an instance of the Rdio object with our consumer credentials
$rdio = new Rdio(array(RDIO_CONSUMER_KEY, RDIO_CONSUMER_SECRET));

//echo 'yo';


# work out what our current URL is
$next_url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") .
  "://" . $_SERVER['SERVER_NAME'].'../website/oauth/a.php'; //$_SERVER['SCRIPT_NAME'];







if ($_SESSION['oauth_token'] && $_SESSION['oauth_token_secret']) {
  
  # we have a token in our session, let's use it
  $rdio->token = array($_SESSION['oauth_token'],
    $_SESSION['oauth_token_secret']);
  if ($_GET['oauth_verifier']) {
	  echo 'C: SECRET???!!!';
	  die('should not have a secret passed to me here, please debug');
	}


  
  //echo 'destroy!';
  //session_destroy();
  //die( $current_url);
  
  
  # make sure that we can in fact make an authenticated call
  $currentUser = $rdio->call('currentUser');
  if ($currentUser) {
    ?><h1><?=$currentUser->result->firstName?>'s Playlists</h1>
      <ul><? 
      //'
    $myPlaylists = $rdio->call('getPlaylists')->result->owned;
    
    # list them
    foreach ($myPlaylists as $playlist) {
      ?><li><a href="<?= $playlist->shortUrl?>"><?=$playlist->name?></a></li><?
    }
    ?></ul><a href="a.php?logout=1">Log out.</a><?
  } else {
    die ('C: wtf auth failed? no current user??');
    
    # auth failure, clear session
    session_destroy();
    # and start again
    header('Location: '.$current_url);
  }
   
} else {
	echo 'C: NO TOKENS?';
}

*/
?>
