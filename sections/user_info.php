<?php
/*
	 * @author Valentin BRICE
	 *
	 * Affichage d'infos de l'utilisateur
	 * 
*/
?>

<div class="belize-hole">
	<p class="text-left">
		<img src="./img/users/<?php print $oUser->getPicture(); ?>" width="60%">
	</p>
	
	<p class="padded lead">
		<?php print $oUser; ?><br>
		
		<small>	
		<?php
		if ( $oUser->isPublicEmail() ) {

			print $oUser->getEmail();

		} ?><br>
		<?php print $oUser->getRatedSongCount(); ?> song<?php if ( $oUser->getRatedSongCount() > 1 ) print 's'; ?> rated<br>
		<?php print $oUser->getCommentedSongCount(); ?> song<?php if ( $oUser->getCommentedSongCount() > 1 ) print 's'; ?> commented<br>
		<?php print $oUser->getKnownSongCount(); ?> song<?php if ( $oUser->getKnownSongCount() > 1 ) print 's'; ?> known<br>
		<?php print $oUser->getOwnedSongCount(); ?> song<?php if ( $oUser->getOwnedSongCount() > 1 ) print 's'; ?> owned<br>
		</small>
	
	</p>
</div>
