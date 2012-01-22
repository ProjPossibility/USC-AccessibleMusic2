<?php

// includes code that will properly deal with the 
// authentication, detecting state and all
$currentUser = 0;
require_once('player_auth.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="js/jquery-1.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script src="js/token.js"></script>
<script src="js/webjava.js"></script>
<script type="text/javascript" src="js/search_jump.js"></script>
<script src="js/shortcut.js"></script>
<link href="css/search.css" rel="stylesheet" type="text/css" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.speechapi.com/static/lib/speechapi-1.3.js"></script>
<script type="text/javascript" src="http://www.speechapi.com/static/lib/swfobject.js"></script>
<script type="text/javascript">
	function init(){
		shortcut.add("z",function(){
			$('#previous').click();
		},{
			'type':'keydown',
			'propagate':true,
			'target':document
		});
		shortcut.add("x",function(){
			$('#play').click();
		},{
			'type':'keydown',
			'propagate':true,
			'target':document
		});
		/*shortcut.add("c",function(){
			document.getElementById('pause').click();
		},{
			'type':'keydown',
			'propagate':true,
			'target':document
		});*/
		shortcut.add("v",function(){
			$('#stop').click();
		},{
			'type':'keydown',
			'propagate':true,
			'target':document
		});
		shortcut.add("b",function(){
			$('#next').click();
		},{
			'type':'keydown',
			'propagate':true,
			'target':document
		});
	}
	window.onload=init();
	function searchEnter(){
		$('#searchbutton').click();
	}
	</script>
<title>Rdio Accessible</title>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

  <script language="JavaScript" type="text/javascript" >

		var words = ["play song", "pause song", "next song", "previous song"];

        function onLoaded() {
  		speechapi.setupRecognition("SIMPLE", document.getElementById('words').value,false,false);
	}

        var flashvars = {speechServer : "http://www.speechapi.com:8000/speechcloud"};
	//var flashvars = {speechServer : "rtmp://www.speechapi.com:1935/firstapp"};
        var params = {allowscriptaccess : "always", wmode : "opaque"};
	var attributes = {};
	attributes.id = "flashContent";
	swfobject.embedSWF("http://www.speechapi.com/static/lib/speechapi-1.6.swf", "myAlternativeContent", "215", "138", "9.0.28", false,flashvars, params, attributes);
	speechapi.setup("eli","password",onResult, 
			onFinishTTS, onLoaded, "flashContent");

	function speak(text) {
		speechapi.speak(text,"male");
	}

	function onResult(result) {
		//document.getElementById('answer').innerHTML = result.text;
		speechapi.speak(result.text,"male");
		if(result.text == "play song"){
			$('#play').click();
			alert("play song");
			//speak("playing song "+$('#track').text(),"male");
		}
		else if(result.text == "pause song"){
			$('#play').click();
			alert("pause song");
			//speak("paused song "+$('#track').text(),"male");
		}
		else if(result.text == "next song"){
			$('#next').click();
			alert("next song");
			//speak($('#track').text(),"male");
		}
		else if(result.text == "previous song"){
			$('#previous').click();
			alert("previous song");
			//speak($('#track').text(),"male");
		}
	}
	function onFinishTTS() {
		//alert("finishTTS");
	}
	function speakNowPlaying(){
		speak("now playing "+$('#track').text(),"male");
	}
	
	
</script>


</head>

<body onload="MM_preloadImages('img/ardiologo2.jpg','img/blackBWD.png','img/invertedBWD.png','img/blueBWD.png','img/blackPlaypause.png','img/blackFWD.png','img/blackSearch.png')">
<div id="header-wrap">
<div id="header-container">
<div id="header">
<div id="left">
<div id="userID">sign in</div>
<div id="albumcover"><img src="img/blank1x1.gif" id="art" width="150" height="150" /></div>
</div>
<div id="center">
<div id="buttons">
<div id="apiswf" style="visibility:hidden;"></div>
 <img src="img/stop.png" alt="stop" name="stop" id="stop" style="visibility:hidden; position:absolute; left:-999px;" />
<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Previous','','img/blackBWD.png',1)"  onmousedown="MM_swapImage('Previous','','img/invertedBWD.png',1)" onmouseup="MM_swapImage('Previous','','img/blueBWD.png',1)" ><img src="img/blueBWD.png" alt="Previous" name="Previous" width="133" height="108" border="0" id="previous" /></a>
<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Play Pause','','img/blackPlaypause.png',1)" onmousedown="MM_swapImage('Play Pause','','img/invertedPlaypause.png',1)" onmouseup="MM_swapImage('Play Pause','','img/bluePlaypause.png',1)"><img src="img/bluePlaypause.png" alt="Play Pause " name="Play Pause" width="133" height="108" border="0" id="play" /></a>
<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Forward','','img/blackFWD.png',1)" onmousedown="MM_swapImage('Forward','','img/invertedFWD.png',1)" onmouseup="MM_swapImage('Forward','','img/blueFWD.png',1)"><img src="img/blueFWD.png" alt="Forward" name="Forward" width="133" height="108" border="0" id="forward" /></a></div>
<div id="playing">
  <div id="currentstate"></div>
<div id="track" style="width:425px; text-decoration:underline;"></div>
<div id="artist" style="width:425px;"></div>
<div id="album" style="width: 425px; font-style:italic;" ></div>
</div>
</div>
<div id="right"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('aRdio Logo','','img/ardiologo2.png',1)"><img src="img/ardiologo.png" alt="aRdio Logo" name="aRdio Logo" width="280" height="180" border="0" id="aRdio Logo" /></a></div>
</div>
</div>
</div>
<div id="container">
<div id="body">
	<input id="play_key" style="visibility:hidden;" value="a455755" />
<!--<<<<<<< HEAD
    <div>
	<form name="searchForm" id = "searchForm" onsubmit="searchEnter(); return(false);" >
		<input type="text" id="query" alt="Search box" style="left;"/>
		<select id = "search_type" style="left;">
			<option value = "all">All</option>
			<option value="artist">Artist</option>
			<option value = "album">Album</option>
			<option value = "track">Songs</option>
			<option value = "playlist">Playlist</option>
		</select>
		<img src="img/search.png" alt="search" id="searchbutton" style="left;" class="playerSearch" />
	
	</form>

   <input type="hidden" id="words" value="play song, pause song, next song, previous song" size="100" style="left;" />
    <div><div id="myAlternativeContent" style="right;"></div>
	<div id="flashContent" style="right;"></div></div></div>
<br>
	<div id = "searchsuggest"></div>
=======
-->
    <div><div style="float:left;">
	
	<form name="searchForm" id = "searchForm" onsubmit="searchEnter(); return(false);" >
	<input id="query" alt="Search box" style="font-size:large;" /><select id = "search_type" style=" font-size:large;">
		<option value = "all">All</option>
		<option value="artist">Artist</option>
		<option value = "album">Album</option>
		<option value = "track">Songs</option>
		<option value = "playlist">Playlist</option>
	</select>
      <a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Search','','img/blackSearch.png',1)" onmousedown="MM_swapImage('Search','','img/invertedSearch.png',1)" onmouseup="MM_swapImage('Search','','img/blueSearch.png',1)"><img src="img/blueSearch.png" alt="Search" name="Search" width="100" height="81" border="0" id="searchbutton" class="playerSearch" /></a>
	  
	</form>
	<a onclick="speakNowPlaying()">Now Playing</a>
      <input type="hidden" id="words" value="play song, pause song, next song, previous song" size="100" style="left;" /></div>
    <div style="float:right;">
    <div id="myAlternativeContent"></div>
	<div id="flashContent" style="float:right;"></div>
    </div>
    </div>
<br />
	<div id = "searchsuggest" style="clear:both;"></div>

</div>
</div>
</body>
</html>
