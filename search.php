<?php
	require_once "config/config.inc";
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
				<div class="col-md-7">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active nephritis">
							<a href="#songs" data-toggle="tab">Songs</a>
						</li>
						<li class="carrot">
							<a href="#albums" data-toggle="tab" class="">Albums</a>
						</li>
						<li class="belize-hole">
							<a href="#artists" data-toggle="tab" class="">Artists</a>
						</li>
						<li class="wisteria">
							<a href="#users" data-toggle="tab" class="">Users</a>
						</li>
					</ul>
					<div class="peter-river">
						<div class="tab-content">
							<div class="tab-pane active nephritis" id="songs">
								<form>
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-4">
												<input type="text" name="title" placeholder="Title">
											</div>
											<div class="col-md-4">
												<input type="text" name="artist" placeholder="Artist">
											</div>
											<div class="col-md-4">
												<input type="text" name="album" placeholder="Album">
											</div>
										</div><br>
										<div class="row">
											<div class="col-md-12">
												<input type="text" name="lyrics" placeholder="Type some lyrics to find a song">
											</div>
										</div><br>
										<div class="row">
											<div class="col-md-3">
												<select class="form-control" multiple>
													<option disabled>
														Genre
													</option>
													<option>
														Rock
													</option>
													<option>
														Rap
													</option>
													<option>
														Blues
													</option>
													<option>
														Hip Hop
													</option>
													<option>
														Reggae
													</option>
												</select>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Leave fields empty to get rid of them.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Search</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="tab-pane carrot" id="albums">
								<form>
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-3">
												<input type="text" name="title" placeholder="Title">
											</div>
											<div class="col-md-3">
												<input type="text" name="song" placeholder="Song">
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-6">
												Apres <input type="range" name="annee" min="1950" max="<?php print date('Y'); ?>" step="10" value="2010">
												<div class="pull-left">
													1950
												</div>
												<div class="text-right">
													<?php print date('Y'); ?>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Leave fields empty to get rid of them.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Search</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="tab-pane belize-hole" id="artists">
								<form>
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-4">
												<input type="text" name="name" placeholder="Name">
											</div>
											<div class="col-md-4">
												<input type="text" name="song" placeholder="Song">
											</div>
											<div class="col-md-4">
												<input type="text" name="album" placeholder="Album">
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Leave fields empty to get rid of them.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Search</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="tab-pane wisteria" id="users">
								<form>
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-6">
												<input type="text" name="name" placeholder="Name">
											</div>
											<div class="col-md-6">
												<input type="email" name="email" placeholder="E-mail">
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Leave fields empty to get rid of them.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Search</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="alizarin" id="users2">
						<p class="lead padded">
							Results
						</p>
						<hr>
					</div>
				</div>
			</div><!-- .row -->
		</section>
		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>