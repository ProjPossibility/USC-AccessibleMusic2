<?php
include_once('../lib/debug.php');
include_once('../lib/no_cache.php');

# (c) 2011 Rdio Inc
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.



session_start();

require_once '../lib/rdio.php';
require_once '../lib/rdio-credentials.php';

# create an instance of the Rdio object with our consumer credentials
$rdio = new Rdio(array(RDIO_CONSUMER_KEY, RDIO_CONSUMER_SECRET));

//echo 'yo';

# work out what our current URL is
$current_url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") .
  "://" . $_SERVER['SERVER_NAME'].'/website/oauth/c.php'; //$_SERVER['SCRIPT_NAME'];




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
    
    echo 'token0: '.$rdio->token[0];
    echo '<br>token1: '.$rdio->token[1];
  } else {
	  echo 'B: NO SECRET?';
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
   ?><a href="c.php">asdfasdfasdf to c</a><?php
   //header('Location: '.$current_url);
} else {
	echo 'B: NO TOKENS?';
}


?>