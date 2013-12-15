<?php
        foreach ( $artist->getAlbums() as $album ):
?>
        <div class="pomegranate">
                <img src="<?php print $album->getArtwork("large"); ?>" width="150 px">
                <p class="lead" style="display:inline-block; vertical-align:middle">
                        <?php print $album->getReleaseDate()->format("Y"); ?><br>
                        <a href="<?php print $album->getUrl(); ?>" data-toggle="tooltip" title="<?php print $album; ?>"><?php print truncateTextByChars( $album, 22 ); ?></a>
                </p>
        </div>
        <div class="padded"></div>
<?php
        endforeach;
?>