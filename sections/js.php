<!-- JS BEGIN -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/jquery.validate.min.js"></script>

<script type="text/javascript" src="./js/bootstrap.min.js"></script>

<script type="text/javascript" src="./js/additional-methods.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-slider.js"></script>
<script type="text/javascript" src="./js/typeahead.js"></script>
<script type="text/javascript" src="./js/tag-it.js" charset="utf-8"></script>

<script type="text/javascript" src="./js/ko.js"></script>
<script type="text/javascript" src="./js/gc.js"></script>
<script type="text/javascript" src="./js/add.js"></script>
<script type="text/javascript" src="./js/rate.js"></script>
<script type="text/javascript">
	$('a').tooltip();
	var artists_search, albums_search, songs_search, users_search, items;
	
	$.post(
		"ajax.artists.php",
		{},
		function(data) {
			for (var i in data) 
				if (data[i] === null) 
					data[i] = "";
			artists_search = data;			
			$.post(
				"ajax.albums.php",
				{},
				function(data) {
					for (var i in data) 
						if (data[i] === null) 
							data[i] = "";
					albums_search = data;					
					$.post(
						"ajax.songs.php",
						{},
						function(data) {
							for (var i in data) 
								if (data[i] === null) 
									data[i] = "";
							songs_search = data;							
							$.post(
								"ajax.users.php",
								{},
								function(data) {
									for (var i in data) 
										if (data[i] === null) 
											data[i] = "";
									users_search = data;									
									items = artists_search.concat(albums_search).concat(songs_search).concat(users_search);
									$("#search").typeahead( {
										source: items,
									} ).on('change', function (event) {
										$("#form-search").submit();
									});
								}
							);
						}
					);
				}
			);
		}
	);
</script>
<!-- JS END -->