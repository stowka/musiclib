<?php
	require_once "config/config.inc";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta author="Antoine Mady">
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
						<li class="nephritis">
							<a href="#artists" data-toggle="tab"><h3 class="text-center">Add artist</h3></a>
						</li>
						<li class="carrot active">
							<a href="#albums" data-toggle="tab"><h3 class="text-center">Add album</h3></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content">
						<div class="tab-pane nephritis" id="artists">
							<?php
								require_once "sections/add_artist.php";
							?>	
						</div>
						<div class="tab-pane active carrot" id="albums">
							<?php
								require_once "sections/add_album.php";
							?>	
						</div>
					</div>
				</div>
			</div>

		</section>
		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>
