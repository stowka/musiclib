<div class="tab-pane active nephritis" id="artists">
	<form id="form-add-artist" action="" method="post">
		<fieldset>
			<p class="padded"></p>
			<div class="row">
				<div class="col-md-8">
					<input type="text" name="nameArtist" placeholder="Artist name" required>
				</div>
				<div class="col-md-4">
					<input type="file" name="pictureArtist" value="Picture" required>
				</div>
			</div>
			<p class="padded"></p>
			<div class="row">
				<div class="col-md-12">
					<textarea rows="5" name="biography" placeholder="Artist biography" required></textarea>
				</div>
			</div>
		</fieldset>
		<button id="submit_artist" type="submit" class="btn btn-info btn-lg btn-block" onclick="$('#form-add-artist').submit();">Submit</button>
	</form>
</div>