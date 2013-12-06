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
				<div class="col-md-12">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active nephritis">
							<a href="#artists" data-toggle="tab">Add artist</a>
						</li>
						<li class="carrot">
							<a href="#albums" data-toggle="tab" class="">Add album</a>
						</li>
					</ul>
					<div class="peter-river">
						<div class="tab-content">
							<div class="tab-pane active nephritis" id="artists">
								<form>
									<fieldset>
										<p class="padded"></p>
										<div class="row">
											<div class="col-md-6">
												<input type="text" name="name" placeholder="Name" required>
											</div>
											<div class="col-md-6">
												<input type="file" name="picture" value="Picture" required>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
												<textarea rows="5" name="bigraphy" placeholder="Biography" required></textarea>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Fill every fields.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Submit</button>
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
											<div class="col-md-6">
												<input type="text" name="name" placeholder="Name">
											</div>
											<div class="col-md-6">
												<input type="file" name="artwork" value="Artwork" required>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-2">
												<input type="text" name="disc" placeholder="Disc">
											</div>
											<div class="col-md-4">
												<input type="text" name="releaseDate" placeholder="Release Date">
											</div>
										<!--</div>
										<br>
										<div class="row">-->
											<div class="col-md-4">
												<select class="form-control alternate" id="listType" name="type" placeholder="type">
													<option>
														Single
													</option>
													<option>
														Album
													</option>
													<option>
														Podcast
													</option>
													<option>
														pyqgj
													</option>
												</select>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-9">
												<p class="lead padded">
													Fill every fields.
												</p>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-default btn-lg btn-block">Continue</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div><!--tab-->
					</div><!--class-->
				</div><!--.span-->
			</div><!-- .row -->
		</section>
		<?php
			require_once "sections/js.php";
		?>
	</body>
</html>