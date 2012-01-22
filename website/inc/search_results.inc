<div id="results">
<li id="resultnum">
	<!-- <div id="resultnum"><?=$i?>.</div> -->
	<div id="searchalbum"><img src="<?=$icon?>" width="150" height="150" alt="Album cover" /></div>
	<div id="type"><?=$type?></div>
	<div id="info">
		<?php if ($key != '') { ?>
		<div id="songName"><a href="javascript:search_play('<?=$key?>')"><?=$name?></a></div>
		<div id="empty_div1">&nbsp;</div>
		<?php } ?>
		<div id="artistName"><a href="javascript:search_albums('<?=$artistkey?>')"><?=$artist?></a></div>
	</div>
	<div id="length_explicit">
		<div id="length"><?=($length < 1 ? '' : 'Playlist: ') . $length?></div>
		<div id="empty_div2">&nbsp;</div>
		<div id="explicit"><?=($explicit == 1 ? "Explicit" : "")?></div>
	</div>
	<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</li>
</div>
