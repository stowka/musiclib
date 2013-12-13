<?php
	/*
	 * @author Valentin BRICE
	 * corrected by Antoine De Gieter
	 *
	 * Page de profil d'un utilisateur
	 * 
	 */
	
	require_once "config/config.inc";
	if(isset($_GET['id'])){
		$oUser = new User($_GET['id']);
	}
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
						require_once "sections/user_info.php";
					?>

					<?php
						require_once "sections/user_matched_users.php";
					?>
				</div>

				<div class="col-md-8">
					<?php
						require_once "sections/user_activities.php";
					?>
				</div>
			</div>
		</section>

		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>
