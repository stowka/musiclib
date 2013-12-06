<?php
	require_once "config/config.inc";
	$album = new Album($_GET['id']);
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
		</style>
	</head>


	<body>
		<?php require_once "sections/menu.php"; ?>

		<section class="container">

			<div class="row padded">
				<div class="col-md-12">
					<?php
						require_once "sections/album_header.php";
					?>
				</div>
			</div>


			<div class="row padded">
				<div class="col-md-12">
					<?php
						require_once "sections/album_songs.php";
					?>
				</div>
			</div>


		</section>

		<?php
			require_once "sections/js.php";
		?>


	</body>
</html>