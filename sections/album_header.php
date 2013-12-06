<div class="belize-hole">
	<p  style="display:inline;">
	<img src="<?php print $album->getArtwork(); ?>" height="300px" style="margin-right:20px;">
	</p>
	<h1 style="display:inline-block; vertical-align:middle">
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

	</h1>
	<div class="btn-group btn-group-lg pull-right">
		<button class="btn btn-success" type="button" title="Right informations">
			 <span class="glyphicon glyphicon-thumbs-up"> 0 </span>
		</button>
		<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown" type="button" title="Wrong informations">
			 <span class="glyphicon glyphicon-thumbs-down"> 0 </span>
			 <span class="caret"></span>
		</button>	
		<ul class="dropdown-menu" role="menu">
		    <li><a href="#">Incomplete</a></li>
		    <li><a href="#">Not genuine</a></li>
		    <li><a href="#">Unfounded</a></li>
		    <li><a href="#">Spelling mistake</a></li>
		    <li><a href="#">Rumour</a></li>
		    <li><a href="#">Duplicated Data</a></li>
		</ul>
	</div>
</div>
