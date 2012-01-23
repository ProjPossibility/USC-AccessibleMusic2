
// a global variable that will hold a reference to the api swf once it has loaded
var apiswf = null;
var myPlayState = "2";

$(document).ready(function() {
  // on page load use SWFObject to load the API swf into div#apiswf
  var flashvars = {
    'playbackToken': playback_token, // from token.js
    'domain': domain,                // from token.js
    'listener': 'callback_object'    // the global name of the object that will receive callbacks from the SWF
    };
  var params = {
    'allowScriptAccess': 'always'
  };
  var attributes = {};
  swfobject.embedSWF('http://www.rdio.com/api/swf/', // the location of the Rdio Playback API SWF
      'apiswf', // the ID of the element that will be replaced with the SWF
      1, 1, '9.0.0', 'expressInstall.swf', flashvars, params, attributes);


  // set up the controls
  $('#play').click(function() {
		if(myPlayState == "2"){
			//player has been stopped, play from beginning
			apiswf.rdio_play($('#play_key').val());
		}
		else if(myPlayState == "1"){
			//player is currentl yplaying, pause it
			apiswf.rdio_pause();
		}
		else if(myPlayState == "0"){
			//player has been paused, play starting at current position
			apiswf.rdio_play();
		}
  });
  $('#stop').click(function() { apiswf.rdio_stop(); });
//  $('#pause').click(function() { apiswf.rdio_pause(); });
  $('#previous').click(function() { apiswf.rdio_previous(); });
  $('#next').click(function() { apiswf.rdio_next(); });
  $('#searchbutton').click(function(){
  	  var search_id= document.getElementById("search_type");
  	  var search_type = search_id.options[search_id.selectedIndex];
  	  var phpURL = "search.php";
  	  var ajax_load = "<img src='img/load.gif' alt='loading...' />";
  	  $('#searchsuggest').html(ajax_load).load(phpURL, "query=" + $('#query').val() + "&type=" + search_type.value);
  	  //$('#searchsuggest').load(phpURL);
    });
   $('#suggest40').click(function(){
	   onload_ajax();
   });
   onload_ajax();
});

function onload_ajax() {
	var phpURL = "search.php";
	var ajax_load = "<img src='img/load.gif' alt='loading...' />";
	$('#searchsuggest').html(ajax_load).load(phpURL, "query=blank&type=" + "onload");
}


// the global callback object
var callback_object = {};

callback_object.ready = function ready(user) {
  // Called once the API SWF has loaded and is ready to accept method calls.

  // find the embed/object element
  apiswf = $('#apiswf').get(0);

  apiswf.rdio_startFrequencyAnalyzer({
    frequencies: '10-band',
    period: 100
  });

  if (user == null) {
    $('#nobody').show();
  } else if (user.isSubscriber) {
    $('#subscriber').show();
  } else if (user.isTrial) {
    $('#trial').show();
  } else if (user.isFree) {
    $('#remaining').text(user.freeRemaining);
    $('#free').show();
  } else {
    $('#nobody').show();
  }

  console.log(user);
}

callback_object.freeRemainingChanged = function freeRemainingChanged(remaining) {
  $('#remaining').text(remaining);
}

callback_object.playStateChanged = function playStateChanged(playState) {
	  // The playback state has changed.
	  // The state can be: 0 - paused, 1 - playing, 2 - stopped, 3 - buffering or 4 - paused.
	  var stateText = $('#currentstate');
	  if (playState == 1){
		  stateText.text("Playing: ");
	  } else if (playState == 2){
		  stateText.text("Stopped: ");
	  } else if (playState == 3){
		  stateText.text("Buffering...");
	  } else {
		  stateText.text("Paused: ");
	  }
	  myPlayState = playState;
}

callback_object.playingTrackChanged = function playingTrackChanged(playingTrack, sourcePosition) {
  // The currently playing track has changed.
  // Track metadata is provided as playingTrack and the position within the playing source as sourcePosition.
  if (playingTrack != null) {
    $('#track').text(playingTrack['name']);
    $('#album').text(playingTrack['album']);
    $('#artist').text(playingTrack['artist']);
    $('#art').attr('src', playingTrack['icon']);
    
  }
}

callback_object.playingSourceChanged = function playingSourceChanged(playingSource) {
  // The currently playing source changed.
  // The source metadata, including a track listing is inside playingSource.
}

callback_object.volumeChanged = function volumeChanged(volume) {
  // The volume changed to volume, a number between 0 and 1.
}

callback_object.muteChanged = function muteChanged(mute) {
  // Mute was changed. mute will either be true (for muting enabled) or false (for muting disabled).
}

callback_object.positionChanged = function positionChanged(position) {
  //The position within the track changed to position seconds.
  // This happens both in response to a seek and during playback.
//  $('#position').text(position);
}

callback_object.queueChanged = function queueChanged(newQueue) {
  // The queue has changed to newQueue.
}

callback_object.shuffleChanged = function shuffleChanged(shuffle) {
  // The shuffle mode has changed.
  // shuffle is a boolean, true for shuffle, false for normal playback order.
}

callback_object.repeatChanged = function repeatChanged(repeatMode) {
  // The repeat mode change.
  // repeatMode will be one of: 0: no-repeat, 1: track-repeat or 2: whole-source-repeat.
}

callback_object.playingSomewhereElse = function playingSomewhereElse() {
  // An Rdio user can only play from one location at a time.
  // If playback begins somewhere else then playback will stop and this callback will be called.
}

callback_object.updateFrequencyData = function updateFrequencyData(arrayAsString) {
  // Called with frequency information after apiswf.rdio_startFrequencyAnalyzer(options) is called.
  // arrayAsString is a list of comma separated floats.

  var arr = arrayAsString.split(',');

  $('#freq div').each(function(i) {
    $(this).width(parseInt(parseFloat(arr[i])*500));
  })
}

