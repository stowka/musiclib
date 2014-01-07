<?php
	require_once "config/config.inc";

	$top_songs = Song::top(100);
	$top_albums = Album::top(100);
	$top_artists = Artist::top(100);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
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

				<div class="col-md-4">
					<div class="belize-hole">
						<p class="padded">
							<h3 class="padded text-center"><span class="glyphicon glyphicon-music"></span> Top Songs</h3>	
							<hr>
							<?php
								$c=1;
								foreach($top_songs as $song):
									print '<p class="padded">';
									print $c.'. <a href="'.$song->getUrl().'" data-toggle="tooltip" title="'.$song.'">';
									print truncateTextByChars( $song ) . '</a></p><h6 class="padded"> by <a href="'. $song->getMainArtist()->getUrl() . '" >' .$song->getMainArtist(). '</a></h6>' ;
									print '<div class="image-cropper"><img src="'. $song->getMainAlbum()->getArtwork() . '" width="100%" class="centered"></div>';
									print '<hr>';
									$c++;
								endforeach;
							?>		
						</p>
					</div>

				</div>

				<div class="col-md-4">
					<div class="pomegranate">
						<p class="padded">
							<h3 class="padded text-center"><span class="glyphicon glyphicon-user"></span> Top Artists</h3>
							<hr>
							<?php
								$c=1;
								foreach($top_artists as $artist):
									print '<p class="padded">';
									print $c.'. <a href="'.$artist->getUrl().'" data-toggle="tooltip" title="'.$artist.'">';
									print truncateTextByChars( $artist ) . '</a></p><h6 class="padded"><br></h6>';
									print '<div class="image-cropper"><img src="img/artists/'. $artist->getPicture() . '" width="100%" class="centered"></div>';
									print '<hr>';
									$c++;
								endforeach;
							?>
						</p>

					</div>

				</div>

				<div class="col-md-4">
					<div class="nephritis">
						<p class="padded">
							<h3 class="padded text-center"><span class="glyphicon glyphicon-headphones"></span> Top Albums</h3>
							<hr>
							<?php
								$c=1;
								foreach($top_albums as $album):
									print '<p class="padded">';
									print $c.'. <a href="'.$album->getUrl().'" data-toggle="tooltip" title="'.$album.'">';
									print truncateTextByChars( $album ) . '</a></p><h6 class="padded"> by <a href="'. $album->getMainArtist()->getUrl() . '" >' .$album->getMainArtist(). '</a></h6>' ;
									print '<div class="image-cropper"><img src="'. $album->getArtwork() . '" width="100%" class="centered"></div>';
									print '<hr>';
									$c++;
								endforeach;
							?>
						</p>
					</div>

				</div>

			</div>
		</section>
		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>