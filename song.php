<?php
	require_once "config/config.inc";
	$song = new Song($_GET['id']);
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta author="Antoine Mady">
		<title><?php print TITLE; ?></title>

		<?php
			require_once "sections/links.php";
		?>
	<style type="text/css">
		.btn-group-lg>.btn{
			border-radius:0px;
		}
		blockquote{
			border-left:none;
			text-align:justify;

		}

		blockquote>p {
			font-size:1em;
		}

		/*TODO
		Mettre dans le fichier CSS
		Arranger le blockquote*/
	</style>
	</head>


	<body>
		<?php require_once "sections/menu.php"; ?>

		<section class="container">

			<div class="row padded">
				<div class="col-md-12">
					<?php
						require_once "sections/song_header.php";
					?>
				</div>
			</div>


			<div class="row padded">
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-12">
							<?php
								require_once "sections/song_albums.php";
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php
								require_once "sections/song_lyrics.php";
							?>
						</div>
					</div>
				</div>

				<div class="col-md-5">
					<?php
						require_once "sections/song_comments.php";
					?>
				</div>
			</div>


		</section>

		<?php
			require_once "sections/js.php";
		?>


	</body>
</html>