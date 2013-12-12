<div class="pomegranate">
	<h4 class="padded">
		Rates (<?php	print $oUser->getRatedSongCount(); ?>)
	</h4>
	<p class="padded">
		<?php
			foreach ( $oUser->getRatedSongs( "date", 3 ) as $rate ):
		?>
				<?php
					print '<small>' . $rate->getDate()->format( "j F Y - H:i:s" ) . '</small><br>';
					print '<a href="song/'.$rate->getSong()->getUrl().'">' . $rate->getSong() . '</a>';
					print ' (' . $rate->getGrade() . ' / 10)';
				?>
				<br>
				<br>
		<?php
			endforeach;
		?>
	</p>
	<hr>
	<h4 class="padded">
		Comments (<?php	print $oUser->getCommentedSongCount(); ?>)
	</h4>
	<p class="padded">
		<?php
			foreach ( $oUser->getCommentedSongs( "date", 3 ) as $comment ):
		?>
				<?php
					print '<small>' . $comment->getDate()->format( "j F Y - H:i:s" ) . '</small><br>';
					print '<a href="song/<?php print $rate->getSong()->getUrl(); ?>">' . $comment->getSong() . '</a>';
				?>
				<br>
				"<?php
					print $comment;
				?>"
				<br>
		<?php
			endforeach;
		?>
	</p>
</div>
