<div id="results">
	<div id="resultnum"><?=$i?>.</div>
	<div id="searchalbum"><img src="<?=$icon?>" width="150" height="150" alt="Album cover" /></div>
	<div id="type"><?=$type?></div>
	<div id="info">
		<div id="songName"><a href="do_ajax_search_or_play(<?=$key?>)"><?=$name?></a></div>
		<div id="artistName"><a href="do_ajax_search_or_play(<?=$artistkey?>)"><?=$artist?></a></div>
	</div>
	<div id="explicit"><?=($explicit == 1 ? "Explicit" : "")?></div>
	<div id="length"><?=$length?></div>
	<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
