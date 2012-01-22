<?php
include_once('lib/debug.php');
include_once('lib/no_cache.php');


// THIS PAGE PICKS UP THE AUTH KEY FOR THE USER AFTER THEY'VE SIGNED IN


session_start();

require_once 'lib/rdio.php';
require_once 'lib/rdio-credentials.php';

# create an instance of the Rdio object with our consumer credentials
$rdio = new Rdio(array(RDIO_CONSUMER_KEY, RDIO_CONSUMER_SECRET));

//echo 'yo';

# work out what our current URL is
$next_url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") .
  "://" . $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$next_url = substr($next_url,0,strrpos($next_url,'/')).'/player.php'; // get just the script path and make an absolute URL from it



if ($_SESSION['oauth_token'] && $_SESSION['oauth_token_secret']) {
  
  # we have a token in our session, let's use it
	$rdio->token = array($_SESSION['oauth_token'],
	  $_SESSION['oauth_token_secret']);
	if ($_GET['oauth_verifier']) {
		# we've been passed a verifier, that means that we're in the middle of
		# authentication.
		$rdio->complete_authentication($_GET['oauth_verifier']);
		# save the new token in our session
		$_SESSION['oauth_token'] = $rdio->token[0];
		$_SESSION['oauth_token_secret'] = $rdio->token[1];

		//echo 'token0: '.$rdio->token[0];
		//echo '<br>token1: '.$rdio->token[1];
	} else {
		header('Location: .');
		//echo 'B: NO SECRET?';
	}

/*
  
  echo 'destroy!';
  session_destroy();
  die( $current_url);
  
  
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
    ?></ul><a href="?logout=1">Log out.</a><?
  } else {
    # auth failure, clear session
    session_destroy();
    # and start again
    header('Location: '.$current_url);
  }
   */
   //echo '<a href="c.php">asdfasdfasdf to c</a>';
   header('Location: '.$next_url);
} else {
	header('Location: .');
	//echo 'B: NO TOKENS?';
}


?>
