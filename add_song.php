<?php
	if( isset($_GET['n']) ){
		$i = $_GET['n'];

		print '<div id="songsAdded'.$i.'" style="display:block;">';
			print '<br>';
			print '<div class="row">';
				print '<div class="col-md-1">';
					print '<h1>'.$i.'</h1>';
				print '</div>';
				print '<div class="col-md-2">';
					print '<input type="text" name="duration" placeholder="Duration">';
				print '</div>';
				print '<div class="col-md-9">';
					print '<input type="text" name="title" placeholder="Title">';
				print '</div>';
			print '</div>';
			print '<div class="row">';
				print '<div class="col-md-4 col-md-offset-1">';
					print '<input type="text" name="songComposeBy" placeholder="Song compose by">';
				print '</div>';
				print '<div class="col-md-4">';
					print '<input type="text" name="songPerformBy" placeholder="Song perform by">';
				print '</div>';
				print '<div class="col-md-3">';
					print '<select class="form-control alternate" id="listGenre" name="genre" style="min-height:40px;">';
						print '<option>Rock</option>';
						print '<option>Pop</option>';
					print '</select>';
				print '</div>';
			print '</div>';
		print '</div>';
	}
?>
