<div id="results">
	<div id="resultnum"><?=$i?>.<!li /></div>
	<div id="searchalbum"><img src="<?=$icon?>" width="150" height="150" alt="Album cover" /></div>
	<div id="type"><?=$type?></div>
	<div id="info">
		<?php if ($type == 'Song') { ?>
			<div id="songName"><a href="javascript:search_play('<?=$key?>')"><?=$name?></a></div>
			<div id="empty_div1">&nbsp;</div>
		<?php } else if ($key != '') { ?>
			<div id="play"><a href="javascript:search_play('<?=$key?>')">Play</a></div>
			<?var_dump($trackKeys)?>
			<div id="albumsearch"><a href="javascript:search_songs('<?=$trackKeys?>','<?=$key?>')"><?=$name?></a></div>
		<?php }?>
		
		<div id="artistName"><a href="javascript:search_albums('<?=$artistkey?>')"><?=$artist?></a></div>
	</div>
	<div id="length_explicit">
		<div id="length"><?=($length < 1 ? '' : 'Playlist: ') . $length?></div>
		<div id="empty_div2">&nbsp;</div>
		<div id="explicit"><?=($explicit == 1 ? "Explicit" : "")?></div>
	</div>
	<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
