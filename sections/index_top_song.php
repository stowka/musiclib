<?php
	$top_song = Song::top();
?>
<div class="belize-hole">
	<div>
		<p class="padded">
			<span class="glyphicon glyphicon-music"></span> Top song
			<span class="pull-right text-right">
				<?php print (float)$top_song->getAverage(); ?> / 10<br>
				<small><?php print (int)$top_song->countRaters(); ?> rater<?php if ((int)$top_song->countRaters() > 1) print 's'; ?></small>
			</span>
			<br>
			<div class="progress">
				<div class="progress-bar silver" role="progressbar" aria-valuenow="<?php print (int)($top_song->getAverage() * 10); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print (int)($top_song->getAverage() * 10); ?>%"></div>
			</div>
			<p class="padded">
				<?php print Song::top()->getTitle(); ?><br>
				<small>by <?php print $top_song->getMainArtist(); ?></small><br>
			</p>
			<div class="row">
				<div class="col-md-12">
					<img src="<?php print $top_song->getMainAlbum()->getArtwork(); ?>" width="100%">
				</div>
			</div>
		</p>
	</div>
</div>