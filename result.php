<?php
	require_once "config/config.inc";
	isset($_GET['q']) && empty( $_GET['q']) && Page::go404();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta author="Jérôme Boesch">
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

				<div class="col-md-3">
					<div class="alizarin">
						<h3 class="padded">Songs</h3>
						<hr>
						<p class="padded">
							<?php
								foreach($search_songs as $song):
									print '<a href="'.$song->getUrl().'">';
									print $song . "</a><br>";
								endforeach;
							?>
						</p>
					</div>
				</div>

				<div class="col-md-3">
					<div class="peter-river">	
						<h3 class="padded">Artists</h3>
						<hr>
						<p class="padded">
							<?php
								foreach($search_artists as $artist):
									print '<a href="'.$artist->getUrl().'">';
									print $artist . "</a><br>";
								endforeach;
							?>
						</p>
					</div>
				</div>

				<div class="col-md-3">
					<div class="nephritis">
						<h3 class="padded">Albums</h3>
						<hr>
						<p class="padded">
							<?php
								foreach($search_albums as $album):
									print '<a href="'.$album->getUrl().'">';
									print $album . "</a><br>";
								endforeach;
							?>
						</p>
					</div>
				</div>

				<div class="col-md-3">
					<div class="carrot">
						<h3 class="padded">Users</h3>
						<hr>
						<p class="padded">
							<?php
								foreach($search_users as $user):
									print '<a href="'.$user->getUrl().'">';
									print $user . "</a><br>";
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
