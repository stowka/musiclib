<?php
	require_once "config/config.inc";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta author="Alexis Beaujon">
		<title>
			<?php print TITLE; ?>
		</title>
		<?php
			require_once "sections/links.php";
		?>
	</head>
	<body>
		<?php require_once "sections/menu.php"; ?>
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active nephritis">
							<a href="#artists" data-toggle="tab">Add artist</a>
						</li>
						<li class="carrot">
							<a href="#albums" data-toggle="tab" class="">Add album</a>
						</li>
					</ul>
					<div class="peter-river">
						<div class="tab-content">
							<div class="tab-pane active nephritis" id="artists">
								<form id="form-add-artist" action="" method="post">
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-6">
												<input type="text" name="nameArtist" placeholder="Name" required>
											</div>
											<div class="col-md-6">
												<input type="file" name="pictureArtist" value="Picture" required>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
												<textarea rows="5" name="biography" placeholder="Biography" required></textarea>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Fill every fields.
												</p>
											</div>
											<div class="col-md-3">
												<button type="button" class="btn btn-default btn-lg btn-block" onclick="$('#form-add-artist').submit();">Submit</button>
												<?php
													if (isset($_POST['nameArtist']) && isset($_POST['biography']) && isset($_POST['pictureArtist']) )
														Artist::create( $_POST['nameArtist'], $_POST['biography'], $user->getId(), $_POST['pictureArtist'] );
												?>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="tab-pane carrot" id="albums">
								<form id="form-add-album" action="" method="post">
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-8">
												<input type="text" name="nameAlbum" placeholder="Name">
											</div>
											<div class="col-md-1">
												<input type="text" name="disc" placeholder="Disc">
											</div>
											<div class="col-md-3">
												<select class="form-control alternate" id="listType" name="type" style="min-height: 40px;">
													<option>Single</option>
													<option>Album</option>
													<option>Live</option>
													<option>Compilation</option>
													<option>Best Of</option>
													<option>Studio</option>
													<option>Podcast</option>
													<option>pyqgj</option>
												</select>
											</div>
										</div>
										<br><br>
										<div class="row">
	 										<div class="col-md-2">
												<input type="text" name="releaseDate" placeholder="Release Date">
											</div>
											<div class="col-md-4">
												<input type="text" name="albumByArtist" id="albumByArtist" placeholder="Artist who release this album">
												<!--remplissage automatique-->
											</div>
											<div class="col-md-3 col-md-offset-1">
												<h4>Number of songs</h4>
												<input type="text" name="nbSong" id="nbSong" hidden>
											</div>
											<div class="col-md-1">
												<button type="button" class="btn btn-default" onclick="moreSong()">+</button>
											</div>
											<div class="col-md-1">
												<button type="button" class="btn btn-default" onclick="lessSong()">-</button>
											</div>
										</div>
										<hr>
										<div id="songsList">
										<?php
											print '<div class="row">';
												print '<div class="col-md-1">';
													print '<h1>1</h1>';
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
										?>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Fill every fields.
												</p>
											</div>
											<div class="col-md-3">
												<button type="button" class="btn btn-default btn-lg btn-block" onclick="$('#form-add-album').submit();">Submit</button>
												<?php
													// if( isset($_POST['nameAlbum']) && isset($_POST['disc']) && isset($_POST['releaseDate']) && isset($_POST['type']) && isset($_POST['albumByArtist']) ){
													// 	Album::create( $_POST['nameAlbum'], $_POST['disc'], $_POST['releaseDate'], '', $user->getId(), $_POST['type'] );
													// 	//Ajout relation release (artist-album)
													// }
													

													// $z ='';
													// if( isset($_POST['nbSong']) ){
													// 	$nbSong = $_POST['nbSong'];
													// 	while( $z < $nbSong ){
													// 		//Ajout de include (album-song-track)
													// 		//Ajout de la relation belong (song-genre)
													// 		//Ajout de la relation compose (artist-song)
													// 		//Ajout de la relation perform (artist-song)
													// 		z++;
													// 	}
													// }
												?>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div><!--tab-->
					</div><!--class-->
				</div><!--.span-->
			</div><!-- .row -->
		</section>
		<?php
			require_once "sections/js.php";
		?>

		<script>
			nbSong = 1;
			function moreSong(){
				nbSong++;
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			    		document.getElementById("songsList").innerHTML += xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "add_song.php?n="+nbSong, true);
				xmlhttp.send();
			}
			function lessSong(){
				document.getElementById("songsAdded"+nbSong).style.display = "none";	
				nbSong--;
			}
			function countNbSong(){
				document.getElementById("nbSong").value = nbSong;
			}
			//Fonction JS comptant le nombre de div class="songsX"
		</script>
	</body>
</html>

