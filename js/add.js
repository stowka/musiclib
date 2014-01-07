function newSong(n)
{
	var text='<div class="row" id="song_'+n+'"><input class="last" value="true" type="hidden"><div class="col-md-1"><span class="track_song" type="number" value="'+n+'"><p class="padded lead">'+n+'.</p></span></div><div class="col-md-3"><input class="title_song" type="text" value="" onkeyup="javascript:addSong('+n+');" placeholder="Song title" name="title_'+n+'"></div><div class="col-md-4"><input type="text" class="genre_song" onchange="javascript:addSong('+n+');" name="genres_'+n+'"></div><div class="col-md-4"><input type="text" class="artist_song" onchange="javascript:addSong('+n+');" name="artists_'+n+'"></div></div>';
	return text;
}

function addTags(n) {
	var tag_artist = $(".artist_album").tagit("assignedTags"); 
	for (t in tag_artist)
		$("#song_"+n+" .artist_song").tagit("createTag", tag_artist[t]);
	var tag_genre = $(".genre_album").tagit("assignedTags"); 
	for (t in tag_genre)
		$("#song_"+n+" .genre_song").tagit("createTag", tag_genre[t]);
}


function tag() {
	$(".artist_song").tagit({
		availableTags: artists,
		placeholderText:'Performed by',
		allowSpaces:true,
		removeConfirmation:true,
		beforeTagAdded: function(event, ui) {
			var txt = ui.tag[0].innerText;
			txt = txt.substring(0, txt.length - 1);
			for(a in artists)
				if(txt === artists[a])
					return true;
			return false;
		}
	});
		$(".genre_song").tagit({
		availableTags: genres,
		placeholderText:'Genre(s)',
		allowSpaces:true,
		removeConfirmation:true,
		beforeTagAdded: function(event, ui) {
			var txt = ui.tag[0].innerText;
			txt = txt.substring(0, txt.length - 1);
			for(a in genres)
				if(txt === genres[a])
					return true;
			return false;
		}
	});
}

function addSong(n)
{
	if( n === 0 ) {
		$("#songs").append(newSong(1));
		tag();
		addTags(n + 1);
		$('#btn_cancel').removeClass('hidden');
	}
	if ( $("#song_"+n+" .last").val() === "true" 
		&& $("#song_"+n+" .genre_song").val().length > 0 
		&& $("#song_"+n+" .title_song").val().length > 0
		&& $("#song_"+n+" .artist_song").val().length > 1 ) 
	{
		$("#songs").append(newSong(n + 1));
		$(".title_song_"+n).attr("required");
		$(".genre_song_"+n).attr("required");
		$(".artist_song_"+n).attr("required");
		$("#song_"+n+" .last").val("false");
		tag();
		addTags(n + 1);
		if(n === 1){
			$('#submit_album').removeClass('hidden');
		}

	}
	
}

function validateAlbum() {
	if( $('#artists_list').val().length > 0 
	&& $('#release_date').val().length === 10 
	&& parseInt( $('#disc').val() ) > 0 
	&& $('#album_name').val().length > 0 
	&& !$('#song_1').length ) {
		$('#btn_add_song').removeClass('hidden');
		$('#artworks').removeClass('hidden');
		var artwork;
		$('#artworkFromLastfm').html('<img text-align="center" src="img/ressources/loading.gif">');
		$.post( 
			"ajax.artwork.php", 
			{
				album: $('#album_name').val(),
				artists: $('#artists_list').val()
			}, 
			function(data) {
				$('#artworkFromLastfm').html('<img width="100%" src="' + data + '">');
			}
		);
		return true;
	}
	return false;
}

function validateArtist() {
	if( $('#name_artist').val().length > 0 
	&& $('#pic_artist').val().length > 0
	&& $('#bio_artist').val().length > 0 ) 
	{
		$('#submit_artist').removeClass('hidden');
	}
}



var artists, genres;
$.post( "ajax.artists.php", {}, function(data) {
	for (var i in data) 
		if (data[i] === null) 
			data[i] = "";
	artists = data;
		$(".artist_album").tagit({
			availableTags: artists,
			placeholderText:'Released by',
			allowSpaces:true,
			removeConfirmation:true,
			beforeTagAdded: function(event, ui) {
				var txt = ui.tag[0].innerText;
				txt = txt.substring(0, txt.length - 1);
				for(a in artists)
					if(txt === artists[a])
						return true;
				return false;
			}
		});
	} );

$.post( "ajax.genres.php", {}, function(data) {
	genres = data;
	$(".genre_album").tagit({
		availableTags: genres,
		placeholderText:'Genre(s) (optional)',
		allowSpaces:true,
		removeConfirmation:true,
		beforeTagAdded: function(event, ui) {
			var txt = ui.tag[0].innerText;
			txt = txt.substring(0, txt.length - 1);
			for(a in genres)
				if(txt === genres[a])
					return true;
			return false;
		}
	});
} );
