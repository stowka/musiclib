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
		<!-- 
			In case of right answer 
		-->
			<div id="rightAnswer" class="row hidden">
				<div class="col-md-12" style="padding:0px">
					<div class="alert alert-success">
						<button type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
						Good job! You earn 1 point!
					</div>
				</div>
			</div>

		<!-- 
			In case of wrong answer -> see the artist
		-->			
			<div id="wrongAnswer" class="row hidden">
				<div class="col-md-12" style="padding:0px">
					<div class="alert alert-danger">
						<button type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
						<br>
					</div>
				</div>
			</div>

			<!-- 
				The Game 
			-->

			<div id="game">
				<div class="row">
					<div class="col-md-5">
						<img id="img_artist" width="450px">
						<input type="hidden" id="newArtist">
					</div>
					<div class="col-md-7 pomegranate" id="question" style="padding:0">
						<p id="score" class="padded"></p>
						<p id="lastGames" class="padded"></p>
						<select size="4" id="artistList" class="form-control" style="position:absolute;bottom:0;right:0px" display="block" onchange="javascript:artistChange()">
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

			var Games = new Array();
			var nbpoints=0;
			var art= new Array();
		
			function reloadPage(nbpoints) {
				$.post( "ajax.404.php", {}, function(data) {
					art=data;
					for (var i = 0; i < 4; i++)
					{
							if (parseInt(Math.random() * 2) == 0)
							{
								$('#artistList').append('<option value=' + art[i][0] + '>' + art[i][1] + '</option>');
							}
							else
							{
								$('#artistList').prepend('<option value=' + art[i][0] + '>' + art[i][1] + '</option>');
							}
					}
					$('#newArtist').val(art[0][1]);
					$('#img_artist').attr("src","img/artists/" + art[0][2]);
					setTimeout(function() {
					$('#question').height($('#img_artist').height());
					}, 100); 
				} );
			}

			function checkArtist() {
				if($('#artistList option:selected').text() == $('#newArtist').val())
				{
					nbpoints=nbpoints+1;
					$('#wrongAnswer').addClass('hidden');
					$('#rightAnswer').removeClass('hidden');
				}
				else{
					Games.unshift(nbpoints);
					var x="";
					for (var k = 1 in Games)
					{
						x = x + Games[k] + ' points <br>';
					}
					$('#lastGames').html('<u>Last games:</u><br>' + x);
					nbpoints=0;	
					$('.alert-danger').html("<p>Nice try but it was <a href='" + art[4][0] + "'>"+ $('#newArtist').val() + "</a></p>");
					$('#wrongAnswer').removeClass('hidden');
					$('#rightAnswer').addClass('hidden');
				}
				$('#answer').addClass('hidden');
				$('#artistList').css({bottom:"0px", left: "0px"});
				$('#artistList option').remove();
				reloadPage(nbpoints);
				$('#score').html(nbpoints>1 ? 'You have ' + nbpoints + ' points!' : 'You have ' + nbpoints + ' point!');
			}


			function artistChange() {
				$('#wrongAnswer').addClass('hidden');
				$('#rightAnswer').addClass('hidden');
				$('#answer').removeClass('hidden');
				$('#answer').html('I think this picture represents '+ $('#artistList option:selected').text());
				$('#artistList').css({bottom:"50px", left: "0px"});
			}
		</script>
	</body>
</html>
