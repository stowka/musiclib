<div class="belize-hole">
        <p style="display:inline;">
                <img src="img/artists/<?php print $artist->getPicture(); ?>" width="300px" style="margin-right:20px;">
        </p>
        <h2 style="display:inline-block; vertical-align:middle">
                <?php print $artist; ?><br>
                <small class="text-clouds">
                                <?php 
                $raterCount = $artist->countRaters();
                if ($raterCount > 0)
                {
                        print 'Average: ' . (float)$artist->getAverage() . ' / 10 (' . $raterCount . ' rater';
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
	                <form method="post" action="<?php print $artist->getUrl(); ?>" id="notarizeAgree" style="display:inline;">
	                	<input type="hidden" name="artist">
	                	<input type="hidden" name="agree">
	                	<input type="hidden" name="cause">
	                	<button class="btn btn-success" type="submit" title="Right informations" <?php print $artist->isAgreedBy( $_SESSION['user']->getId() ) ? 'disabled' : ''; ?>>
	                         <span class="glyphicon glyphicon-ok"> <?php print NotarizeArtist::countAgreeByArtist( $artist->getId() ); ?></span>
	                	</button>
	                </form>
	                <form method="post" action="<?php print $artist->getUrl(); ?>" id="notarizeDisagree" style="display:inline;">
	                	<input type="hidden" name="artist">
	                	<input type="hidden" name="disagree">
	                	<input type="hidden" id="cause" name="cause" value="0">
	                	<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown" type="button" title="Wrong informations" <?php print $artist->isDisagreedBy( $_SESSION['user']->getId() ) ? 'disabled' : ''; ?>>
	                         <span class="glyphicon glyphicon-ban-circle"> <?php print NotarizeArtist::countDisagreeByArtist( $artist->getId() ); ?></span>
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