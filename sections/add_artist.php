<div class="tab-pane active nephritis" id="artists">
	<form id="form-add-artist" action="" enctype="multipart/form-data" method="post">
		<input type="hidden" name="add_artist">
		<fieldset>
			<p class="padded"></p>
			<div class="row">
				<div class="col-md-8">
					<input type="text" name="name" placeholder="Name" required>
				</div>
				<div class="col-md-4">
					<input type="file" name="picture" value="Picture" required>
				</div>
			</div>
			<p class="padded"></p>
			<div class="row">
				<div class="col-md-12">
					<textarea rows="5" name="biography" placeholder="Biography" required></textarea>
				</div>
			</div>
		</fieldset>
		<button id="submit_artist" type="submit" class="btn btn-info btn-lg btn-block">Submit</button>
	</form>
</div>