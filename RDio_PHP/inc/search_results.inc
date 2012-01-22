<div id="results">
	<div id="resultnum"><?=$i?></div>
	<div id="searchalbum"><img src="<?=$value->icon?>" width="150" height="150" alt="Album cover" /></div>
	<div id="type"><?=$value->type?></div>
	<div id="info">
		<div id="songName"><a href="do_ajax_search_or_play(<?=$value->key?>)"><?=$value->name?></a></div>
		<div id="artistName"><a href="do_ajax_search_or_play(<?=$value->artistKey?>)"><?=$value->artist?></a></div>
	</div>
	<div id="explicit"><?=($value->isExplicit == 1 ? "Explicit" : "")?></div>
	<div id="length"></div>
	<div style="padding: 5px 0 5px; display: block; clear: both;"></div>
</div>
