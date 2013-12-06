<?php
	require_once "config/config.inc";

	$top_songs = Song::top(2);
	$top_albums = Album::top(2);
	$top_artists = Artist::top(2);
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
									print '<h4 class="padded">';
									print $c.'. <a href="'.$song->getUrl().'">';
									print $song . '</a></h4><h5 class="padded"> by <a href="'. $song->getMainArtist()->getUrl() . '" >' .$song->getMainArtist(). '</a></h5>' ;
									print '<img src="'. $song->getMainAlbum()->getArtwork() . '" width="100%">';
									print '<hr>';
									$c++;
								endforeach;
								$c=1;
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
									print '<h4 class="padded">';
									print $c.'. <a href="'.$artist->getUrl().'">';
									print $artist . '</a></h4><h5 class="padded"><br></h5>';
									print '<img src="img/artists/'. $artist->getPicture() . '" width="100%">';
									print '<hr>';
									$c++;
								endforeach;
								$c=1;
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
									print '<h4 class="padded">';
									print $c.'. <a href="'.$album->getUrl().'">';
									print $album . '</a></h4><h5 class="padded"> by <a href="'. $album->getMainArtist()->getUrl() . '" >' .$album->getMainArtist(). '</a></h5>' ;
									print '<img src="'. $album->getArtwork() . '" width="100%">';
									print '<hr>';
									$c++;
								endforeach;
								$c=1;
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