<form id="form-add-album" action="" method="post">
	<input type="hidden" name="add_album">
	<fieldset>
		<div class="padded"></div>
		<div class="row" id="album_infos">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<input type="text" name="album_name" id="album_name" placeholder="Album name" onchange="javascript:validateAlbum();" required>
					</div>
				</div>
				<div class="padded"></div>
				<div class="row">
					<div class="col-md-3">
						<input type="number" name="disc" id="disc" pattern="[0-9]" min="1" placeholder="Disc" value="1" onchange="javascript:validateAlbum();" required>
					</div>
					<div class="col-md-4">
						<input type="date" name="release_date" id="release_date" placeholder="Release Date (yyyy-mm-dd)" onchange="javascript:validateAlbum();" required>
					</div>
					<div class="col-md-5">
						<input type="text" class="genre_album" name="genres" id="genres_list" onchange="javascript:validateAlbum();">
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<select class="form-control alternate" id="listType" name="type" onchange="javascript:validateAlbum();" required>
							<?php 
							foreach ( AlbumType::all() as $type)
								{
							?>
							<option <?php print ($type->getId()===6) ? '' : 'selected'; ?> 
							value="<?php print $type->getId(); ?>">
								<?php print $type; ?>
							</option>
							<?php 
								}
							?>
						</select>
					</div>
				</div>
				<div class="padded"></div>
				<div class="row">
					<div class="col-md-12">
						<input type="text" class="artist_album" name="artists" id="artists_list" onchange="javascript:validateAlbum();" required>
					</div>
				</div>
			</div>
			<hr>
		</div>
		<div class="row hidden" id="btn_add_song" >
			<div class="col-md-12">
				<div class="padded"></div>
				<button type="button" class="btn btn-default btn-block" onclick="javascript:if(validateAlbum())addSong(0);$('#btn_add_song').addClass('hidden');$('#album_infos').addClass('hidden');">Add songs (make sure album infos are correct)</button>
			</div>
		</div>
		<div class="row hidden" id="btn_cancel">
			<div class="col-md-12">
				<p class="text-center padded">
					<a href="#" class="btn btn-default" onclick="if(confirm('Warning!\nIf you continue, it will remove all the songs you filled.')){$('#songs').html('');$('#album_infos').removeClass('hidden');$('#btn_add_song').removeClass('hidden');$('#submit_album').addClass('hidden');$('#btn_cancel').addClass('hidden');}return false;">Cancel</a>
				</p>
			</div>
		</div>
		<div id="songs">
		</div>				
	</fieldset>
	<button id="submit_album" type="submit" class="btn btn-info btn-lg btn-block hidden">Submit</button>
</form>