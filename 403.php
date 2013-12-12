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

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="alizarin">
						<h1 class="padded">
							A 403 error just occured - Forbidden
						</h1>
						<p class="padded">
							It means you're not allowed to see the contents of this page.
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