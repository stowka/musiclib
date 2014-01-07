<?php
	require_once "config/config.inc";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta author="Antoine De Gieter">
		<title><?php print TITLE; ?></title>

		<?php
			require_once "sections/links.php";
		?>
	</head>

	<body>
		<?php require_once "sections/menu.php"; ?>

		<section class="container">
			<?php
				require_once "sections/alerts.php";
			?>

			<?php
				require_once "sections/index_about.php";
			?>

			<div class="row">
				<div class="col-md-4">
					<?php
						require_once "sections/index_top_song.php";
					?>
				</div>

				<div class="col-md-4">
					<?php
						require_once "sections/index_top_artist.php";
					?>
				</div>

				<div class="col-md-4">
					<?php
						require_once "sections/index_top_album.php";
					?>
				</div>

			</div>

			<?php
				require_once "sections/index_activities.php";
			?>
		</section>

		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>
