<?php
	/**
	 *
	 * @author Antoine Mady
	 *
	 */
?>
<div class="green-sea">

	<h3 class="padded">Lyrics</h3>
	<p class="padded">
	<?php
		if (($song->getLyrics())!=="")
		{
			print $song->getLyrics();
		}
		else
		{
			print 'No Lyrics';
		}
	?>
	</p>
</div>