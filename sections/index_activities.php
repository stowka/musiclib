<div class="padded"></div>
<?php
	foreach ( Activity::last() as $activity ) :
		if ( $activity instanceof Rate ) :
?>
			<div class="pomegranate">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<img src="<?php print $activity->getSong()->getMainAlbum()->getArtwork( "large" ); ?>" alt="Album" width="120px">
					</div>

					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<p class="padded">
							<!--<img src="img/users/<?php print $activity->getUser()->getPicture(); ?>" alt="User" width="40px"> -->
							<a href="<?php print $activity->getUser()->getUrl(); ?>"><?php print $activity->getUser(); ?></a><br>
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
			<div class="amethyst">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<img src="<?php print $activity->getSong()->getMainAlbum()->getArtwork( "large" ); ?>" alt="Album" width="120px">
					</div>

					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<p class="padded">
							<!--<img src="img/users/<?php print $activity->getUser()->getPicture(); ?>" alt="User" width="40px"> -->
							<a href="<?php print $activity->getUser()->getUrl(); ?>"><?php print $activity->getUser(); ?></a><br>
							<small><?php print $activity->getDate()->format( "j F Y - H:i:s" ); ?></small><br>
							<a href="<?php print $activity->getSong()->getUrl(); ?>"><?php print $activity->getSong(); ?></a>
						</p>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<h5 class="padded text-right">
							"<?php print $activity; ?>"
						</h5>
					</div>
				</div>
			</div>
			<div class="padded"></div>
<?php
		elseif ( $activity instanceof Know ) :
?>
			<div class="<?php if ( $activity->isOwned() ) print 'green-sea'; else print 'nephritis'; ?>">
				<div class="row">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<img src="<?php print $activity->getSong()->getMainAlbum()->getArtwork( "large" ); ?>" alt="Album" width="120px">
					</div>

					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<p class="padded">
							<!--<img src="img/users/<?php print $activity->getUser()->getPicture(); ?>" alt="User" width="40px"> -->
							<a href="<?php print $activity->getUser()->getUrl(); ?>"><?php print $activity->getUser(); ?></a><br>
							<small><?php print $activity->getDate()->format( "j F Y - H:i:s" ); ?></small><br>
							<a href="<?php print $activity->getSong()->getUrl(); ?>"><?php print $activity->getSong(); ?></a>
						</p>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
						<h3 class="padded text-right">
							<?php 
								if ( $activity->isOwned() )
									print "Known & Owned";
								else
									print "Known";
							?>
						</h3>
					</div>
				</div>
			</div>
			<div class="padded"></div>
<?php
		endif;
	endforeach;
?>