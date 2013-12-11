<?php
	function compareDates( $a, $b ) { 
		if( $a->getDate()->getTs() === $b->getDate()->getTs() )
			return 0;
		return ( $a->getDate()->getTs() < $b->getDate()->getTs() ) ? 1 : -1;
	}

	$activities = array_merge( $user->getRatedSongs( "date", 3 ), $user->getCommentedSongs( "date", 3 ) );
	usort($activities, "Activity::sort");
	foreach ( $activities as $activity ) :
		if ( $activity instanceof Rate ) :
?>
			<div class="pomegranate">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<img src="<?php print $activity->getSong()->getMainAlbum()->getArtwork( "large" ); ?>" alt="Album" width="120px">
					</div>

					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<p class="padded">
							<small><?php print $activity->getDate()->format( "j F Y - H:i:s" ); ?></small><br>
							<a href="<?php print $activity->getSong()->getUrl(); ?>"><?php print $activity->getSong(); ?></a>
						</p>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<h3 class="padded text-right">
							<?php print $activity->getGrade(); ?> / 10
						</h3>
					</div>
				</div>
			</div>
			<div class="padded"></div>
<?php
		elseif ( $activity instanceof Comment ) :
?>
			<div class="nephritis">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<img src="<?php print $activity->getSong()->getMainAlbum()->getArtwork( "large" ); ?>" alt="Album" width="120px">
					</div>

					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<p class="padded">
							<small><?php print $activity->getDate()->format( "j F Y - H:i:s" ); ?></small><br>
							<a href="<?php print $activity->getSong()->getUrl(); ?>"><?php print $activity->getSong(); ?></a>
						</p>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<h5 class="padded text-right">
							"<?php print $activity->getText(); ?>"
						</h5>
					</div>
				</div>
			</div>
			<div class="padded"></div>
<?php
		endif;
	endforeach;
?>