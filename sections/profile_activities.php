<div class="pomegranate">
	<h4 class="padded">
		Rates (<?php	print $user->getRatedSongCount(); ?>)
	</h5>
	<p class="padded">
		<?php
			foreach ( $user->getRatedSongs( "date", 3 ) as $rate ):
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
		Comments (<?php	print $user->getCommentedSongCount(); ?>)
	</h4>
	<p class="padded">
		<?php
			foreach ( $user->getCommentedSongs( "date", 3 ) as $comment ):
		?>
				<?php
					print '<small>' . $comment->getDate()->format( "j F Y - H:i:s" ) . '</small><br>';
					print '<a href="song/<?php print $rate->getSong()->getUrl(); ?>">' . $comment->getSong() . '</a>';
				?>
				<br>
				"<?php
					print $comment->getText();
				?>"
				<br>
		<?php
			endforeach;
		?>
	</p>
</div>