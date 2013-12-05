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
				<?php print $top_album->getName(); ?><br>
				<small>by <?php print $top_album->getMainArtist(); ?></small><br>
			</p>
			<div class="row">
				<div class="col-md-12">
					<img src="<?php print $top_album->getArtwork(); ?>" width="100%">
				</div>
			</div>
		</p>
	</div>
</div>