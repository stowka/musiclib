<form id="form-add-artist" action="" enctype="multipart/form-data" method="post">
	<input type="hidden" name="add_artist">
	<fieldset>
		<p class="padded"></p>
		<div class="row">
			<div class="col-md-8">
				<input id="name_artist" type="text" name="name" placeholder="Name" onkeyup="javascript:validateArtist();" required>
			</div>
			<div class="col-md-4">
				<input id="pic_artist" type="file" name="picture" value="Picture" onchange="javascript:validateArtist();" required>
			</div>
		</div>
		<p class="padded"></p>
		<div class="row">
			<div class="col-md-12">
				<textarea id="bio_artist" rows="5" name="biography" placeholder="Biography" onkeyup="javascript:validateArtist();" required></textarea>
			</div>
		</div>
	</fieldset>
	<button id="submit_artist" type="submit" class="btn btn-info btn-lg btn-block hidden">Submit</button>
</form>
