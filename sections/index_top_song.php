<?php
	$top_song = Song::top();
	$top_song = $top_song[0];
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
				<a href="<?php print $top_song->getUrl(); ?>" data-toggle="tooltip" title="<?php print $top_song->getTitle(); ?>"><?php print truncateTextByChars( $top_song->getTitle() ); ?></a><br>
				<small>by <a href="<?php print$top_song->getMainArtist()->getUrl(); ?>" data-toggle="tooltip" title="<?php print $top_song->getMainArtist(); ?>"><?php print truncateTextByChars( $top_song->getMainArtist() ); ?></a></small><br>
			</p>
			<div class="row">
				<div class="col-md-12">
					<div class="image-cropper">
						<img src="<?php print $top_song->getMainAlbum()->getArtwork(); ?>" width="100%" class="centered">
					</div>
				</div>
			</div>
		</p>
	</div>
</div>