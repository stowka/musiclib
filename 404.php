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
	<body onload="javascript:reloadPage(0);">
		<?php require_once "sections/menu.php"; ?>
		<section class="container">
			<div id="game">
				<div class="row">
					<div class="col-md-5">
						<img id="img_artist" width="450px">
						<input type="hidden" id="newArtist">
					</div>
					<div class="col-md-7 pomegranate" id="question" style="padding:0">
						<p id="score" class="padded"></p>
						<select id="artistList" class="form-control" style="position:absolute;bottom:0;right:0px;height:50px" display="block" onchange="javascript:artistChange()">
							<option selected="selected" disabled>
								<p>
									Who is on this picture? 
								</p>
							</option>
						</select>
						<button id="answer" type="submit" class="btn btn-info btn-lg btn-block hidden" style="position:absolute;bottom:0;height:50px" display="block" onclick="javascript:checkArtist()"></button>
					</div>
				</div>
			</div>
		</section>
		<?php
			require_once "sections/js.php";
		?>
		<script>
			
			var nbpoints=0;
			var art= new Array();
			function reloadPage(nbpoints) {
				$.post( "ajax.404.php", {}, function(data) {
					art=data;
					var id_1 = art[0][0];
					var name_1 = art[0][1];
					var picture_1 = art[0][2];
					var id_2 = art[1][0];
					var name_2 = art[1][1];
					var picture_2 = art[1][2];
					var id_3 = art[2][0];
					var name_3 = art[2][1];
					var picture_3 = art[2][2];
					var id_4 = art[3][0];
					var name_4 = art[3][1];
					var picture_4 = art[3][2];
					for (var i = 0; i<4; i++)
					{
						var place = parseInt(Math.floor(Math.random()*(i+1)));
						$('#artistList option:eq(' + place + ')').after('<option value=' + art[i][0] + '>' + art[i][1] + '</option>');
					}
					$('#newArtist').val(art[0][0]);
					$('#img_artist').attr("src","img/artists/" + art[0][2]);
					setTimeout(function() {
					$('#question').height($('#img_artist').height());
					}, 100); 
				} );
			}

			function checkArtist() {
				if($('#artistList option:selected').val() == $('#newArtist').val())
				{
					nbpoints=nbpoints+1;
					alert("Good job man!");
					$('#answer').addClass('hidden');
					$('#artistList').css({bottom:"0px", left: "0px"});
					$('#artistList').children('option:not(:first)').remove();
					reloadPage(nbpoints);
					$('#score').html('You have ' + nbpoints + ' points!');
				}
				else{
					alert("Newbie!");
				}
			}


			function artistChange() {
				$('#answer').removeClass('hidden');
				$('#answer').html('I think this picture represents '+ $('#artistList option:selected').text());
				$('#artistList').css({bottom:"50px", left: "0px"});
			}
		</script>
	</body>
</html>
