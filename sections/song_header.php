<div class="belize-hole">
	<div class="row" style="height:300px">
		<div class="col-md-6">
			<h1 class="padded"  style="margin: 50px;">
				<?php print $song ?> <br>
				<small class="text-clouds">
					by <a href="<?php print $song->getMainArtist()->getUrl(); ?>"><?php print $song->getMainArtist(); ?></a>
				</small><br>
				<small class="text-clouds">
					<?php
						$count=0;
						foreach ( $song->getGenres() as $genre )
						{
							if($count!==0):
					 			print ' & ';
					 		endif;
					 		print $genre;
					 		$count++;
					 	} ?> 
				</small><br>
				<small class="text-clouds">
					Duration: <?php print $song->getDuration( 'i \m\i\n s \s\e\c' ); ?> 
				</small>
			</h1>
		</div>
<?php
	if(isset($_SESSION['online']) && $_SESSION['online']):
?>
		<input id="song_id" type="hidden" value="<?php print $song->getId(); ?>">
		<input id="kc" type="hidden" value="<?php print Know::userKnowsSong( $user->getId(), $song->getId() ); ?>">
		<input id="oc" type="hidden" value="<?php print Know::userOwnsSong( $user->getId(), $song->getId() ); ?>">
		<div class="col-md-6">
			<div class="btn-group btn-group-lg pull-right">
				<label class="btn btn-success <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'active' : ''; ?>" id="known_label" data-complete-text="Known" onclick="javascript:checkKO(true);">
					<input id="known_checkbox" type="checkbox" style="display:none;" <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'checked' : ''; ?>>Known
				</label>
				<label class="btn btn-success <?php print Know::userOwnsSong( $user->getId(), $song->getId() ) ? 'active' : ''; ?>" id="owned_label" data-complete-text="Owned" onclick="javascript:checkKO(false);">
					<input id="owned_checkbox" type="checkbox" style="display:none;" <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'checked' : ''; ?>>Owned
				</label>
			</div>
			<div id="rate_song" class="<?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? '' : 'invisible'; ?>">
				<div class="padded"></div>
				<div class="padded"></div>
				<div class="padded"></div>
				<div class="padded"></div>
				<h3 class="text-left padded">
					Grade: <span id="rating_grade"><?php print $song->isRatedBy( $user->getId() ) ? $song->gradeBy( $user->getId() ) : '-'; ?></span> / 10
					<div id="ratesl">
						<div class="slider slider-horizontal" id="rate_slider" style="cursor:pointer;"></div>
					</div>
				</h3>

				<h3 class="text-left padded">
					Average: <span id="rating_average"><?php print (float)$song->getAverage(); ?></span> / 10 <small class="text-clouds">(<span id="count_raters"><?php print $song->countRaters(); ?></span> people rated this song)</small>
					<div id="avgsl">
						<div class="slider slider-horizontal" id="average_slider"></div>
					</div>
				</h3>
				<input type="hidden" id="rate_value" name="rate_value" value="">
				<input type="hidden" id="average_value" name="average_value" value="">
    		</div>
	        
		</div>
<?php
	endif;
?>
	</div>
</div>