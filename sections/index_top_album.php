<?php
	$top_album = Album::top();
	$top_album = $top_album[0];
?>
<div class="nephritis">
	<div>
		<p class="padded">
			<span class="glyphicon glyphicon-headphones"></span> Top album
			<span class="pull-right text-right">
				<?php print (float)$top_album->getAverage(); ?> / 10<br>
				<small><?php print (int)$top_album->countRaters(); ?> rater<?php if ((int)$top_album->countRaters() > 1) print 's'; ?></small>
			</span>
			<br>
			<div class="progress">
				<div class="progress-bar silver" role="progressbar" aria-valuenow="<?php print (int)($top_album->getAverage() * 10); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print (int)($top_album->getAverage() * 10); ?>%"></div>
			</div>
			<p class="padded">
				<a href="<?php print $top_album->getUrl(); ?>" data-toggle="tooltip" title="<?php print $top_album->getName(); ?>"><?php print truncateTextByChars( $top_album->getName() ); ?></a><br>
				<small>by <a href="<?php print$top_album->getMainArtist()->getUrl(); ?>" data-toggle="tooltip" title="<?php print $top_album->getMainArtist(); ?>"><?php print truncateTextByChars( $top_album->getMainArtist() ); ?></a></small><br>
			</p>
			<div class="row">
				<div class="col-md-12">
					<div class="image-cropper">
						<img src="<?php print $top_album->getArtwork(); ?>" width="100%" class="centered">
					</div>
				</div>
			</div>
		</p>
	</div>
</div>