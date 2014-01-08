<div class="belize-hole">
	<p  style="display:inline;">
		<img src="<?php print $album->getArtwork(); ?>" height="300px" style="margin-right:20px;">
	</p>
	<h2 style="display:inline-block; vertical-align:middle">
		<small class="text-clouds">
		<?php print $album->getReleaseDate()->format("jS F Y"); ?><br>
		</small>
		<?php print $album; ?>
		<br><small class="text-clouds">by 
			<?php
		$boucle=1;
		foreach ( $album->getArtists() as $artist ){
			if($boucle!==1):
				print ' & ';
			endif;
			print '<a href="'. $artist->getUrl() . '" >' .$artist. '</a>';
			$boucle+=1;
		}
		?></small><br><br>
		<small class="text-clouds">
		<?php print $album->getType() . ' (Disc ' . $album->getDisc() . ')' ?>
		<br>
		<?php 
		$raterCount = $album->countRaters();
		if ($raterCount > 0)
		{
			print 'Average: ' . (float)$album->getAverage() . ' / 10 (' . $raterCount . ' rater';
			if ($raterCount > 1) 
			{
				print 's';
			}
			print ')';
		}

		?>		
		</small>

	</h2>
	<?php
		if ( isset( $_SESSION['online'] ) && $_SESSION['online'] ):
	?>
		<div class="btn-group btn-group-lg pull-right">
			 <form method="post" action="<?php print $album->getUrl(); ?>" id="notarizeAgree" style="display:inline;">
	        	<input type="hidden" name="album">
	        	<input type="hidden" name="agree">
	        	<input type="hidden" name="cause">
	        	<button class="btn btn-success" type="submit" title="Right informations" <?php print $album->isAgreedBy( $_SESSION['user']->getId() ) ? 'disabled' : ''; ?>>
	                 <span class="glyphicon glyphicon-ok"> <?php print NotarizeAlbum::countAgreeByAlbum( $album->getId() ); ?></span>
	        	</button>
	        </form>
	        <form method="post" action="<?php print $album->getUrl(); ?>" id="notarizeDisagree" style="display:inline;">
	        	<input type="hidden" name="album">
	        	<input type="hidden" name="disagree">
	        	<input type="hidden" id="cause" name="cause" value="0">
	        	<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown" type="button" title="Wrong informations" <?php print $album->isDisagreedBy( $_SESSION['user']->getId() ) ? 'disabled' : ''; ?>>
	                 <span class="glyphicon glyphicon-ban-circle"> <?php print NotarizeAlbum::countDisagreeByAlbum( $album->getId() ); ?></span>
	        	         <span class="caret"></span>
	        	</button>
	        	<ul class="dropdown-menu" role="menu">
	                <?php
	                	foreach ( Cause::all() as $cause ):
	                		if ( (int)$cause->getId() !== 7 ):
	                ?>
	            		<li><a href="#" onclick="javascript:$('#cause').val('<?php print $cause->getId(); ?>'); $('#notarizeDisagree').submit();"><?php print $cause; ?></a></li>
	                <?php
	                		endif;
	                	endforeach;
	                ?>
	        	</ul>
	        </form>
		</div>
	<?php
		endif;
	?>
</div>