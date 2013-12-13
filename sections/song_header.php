<div class="belize-hole">
	<div class="row" style="height:300px">
		<div class="col-md-6">
			<h1 class="padded"  style="margin: 50px;">
				<?php print $song ?> <br>
				<small class="text-clouds">
					by <a href="<?php print $song->getMainArtist()->getUrl(); ?>"><?php print $song->getMainArtist(); ?> </a>
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
					<?php print $song->getDuration(); ?> 
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
                <label class="btn btn-info <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'active' : ''; ?>" id="known_label" data-complete-text="KNOWN" onclick="javascript:checkKO(true);">
                    <input id="known_checkbox" type="checkbox" style="display:none;" <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'checked' : ''; ?>>KNOWN
                </label>
                <label class="btn btn-info <?php print Know::userOwnsSong( $user->getId(), $song->getId() ) ? 'active' : ''; ?>" id="owned_label" data-complete-text="OWNED" onclick="javascript:checkKO(false);">
                    <input id="owned_checkbox" type="checkbox" style="display:none;" <?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? 'checked' : ''; ?>>OWNED
                </label>
    		</div>
	        <h3>
    			<div id="rate_song" class="<?php print Know::userKnowsSong( $user->getId(), $song->getId() ) ? '' : 'invisible'; ?>">
	        		<br><br><br>Rate this song!<br>
	        		<br><br>
        		</div>
		        Average:<br>
		       <br><br>
	        </h3>
		</div>
<?php
	endif;
?>
	</div>
</div>