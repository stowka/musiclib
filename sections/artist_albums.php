<div class="pomegranate">
	<?php
		foreach ( $artist->getAlbums() as $album ):
	?>
		<img src="<?php print $album->getArtwork("large"); ?>" width="150 px">
		<p class="lead" style="display:inline-block; vertical-align:middle">
		<?php print $album->getReleaseDate()->format("Y"); ?><br>
		<?php print $album; ?></p>
		<hr style="margin:0px;">

	<?php
		endforeach;
	?>

</div>