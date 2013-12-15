<?php
	/**
	 *
	 * @author Antoine Mady
	 *
	 */
?>
<div class="pomegranate">
			<?php 
				foreach ( $song->getAlbums() as $album )
				{
			?> 		
			 		<img src="<?php print $album->getArtwork("large"); ?>" width="150 px">
	                <p class="lead padded" style="display:inline-block; vertical-align:middle">
						<?php print $album->getReleaseDate()->format("Y"); ?><br>
						<a href="<?php print $album->getUrl(); ?>" data-toggle="tooltip" title="<?php print $album; ?>"><?php print truncateTextByChars( $album ); ?></a>
	                </p>
	                <hr style="margin:0px;">
	        <?php
			 	} 
			?> 
</div>
<hr>