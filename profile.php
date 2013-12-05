<?php
	require_once "config/config.inc";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
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

			<div class="row">
				<div class="col-md-4">
					<?php
						require_once "sections/profile_info.php";
					?>
				</div>

				<div class="col-md-8">
					<?php
						require_once "sections/profile_activities.php";
					?>
					<?php
						require_once "sections/profile_connection_log.php";
					?>
				</div>
			</div>
		</section>

		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>