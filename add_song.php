<?php
	if( isset($_GET['n']) ){
		$i = $_GET['n'];

		print '<div id="songsAdded'.$i.'" style="display:block;">';
			print '<br>';
			print '<div class="row" >';
				print '<div class="col-md-4">';
					print '<div class="row">';
						print '<div class="col-md-1">';
							print $i;
						print '</div>';
						print '<div class="col-md-10">';
							print '<input type="text" name="duration" placeholder="Duration">';
						print '</div>';
					print '</div><!--row-->';
					print '<br><span style="font-size:1em;"></span>';
					print '<div class="row">';
						print '<div class="col-md-12">';
							print '<input type="text" name="title" placeholder="Title">';
						print '</div>';
					print '</div><!--row-->';
				print '</div>';
				print '<div class="col-md-8">';
					print '<textarea rows="4" name="lyrics" placeholder="Lyrics"></textarea>';
				print '</div>';
			print '</div><!--row-->';
		print '</div>';
	}
?>
