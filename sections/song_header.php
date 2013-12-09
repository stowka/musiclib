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
		<div class="col-md-6">
			<div class="btn-group btn-group-lg pull-right">
                <button class="btn btn-info" type="button">
                         KNOWN
                </button>
                <button class="btn btn-info" type="button">
                         OWNED
                </button>        
        	</div>
        	<!-- <h3>
        	<br><br><br>
        	Rate this song!<br>
        	ICIGUIE3ZGGTFVKJ?RTF5GEDRHJUN<br><br>
        	Average:<br>
        	fdretgyth-gujuik,n urt(fgvcr(tfgv))<br><br>

        	</h3> -->
		</div>
	</div>
</div>