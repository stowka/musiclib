<?php
	$top_artist = Artist::top();
	$top_artist = $top_artist[0];
?>
<div class="pomegranate">
	<div>
		<p class="padded">
			<span class="glyphicon glyphicon-user"></span> Top artist
			<span class="pull-right text-right">
				<?php print (float)$top_artist->getAverage(); ?> / 10<br>
				<small><?php print (int)$top_artist->countRaters(); ?> rater<?php if ((int)$top_artist->countRaters() > 1) print 's'; ?></small>
			</span>
			<br>
			<div class="progress">
				<div class="progress-bar silver" role="progressbar" aria-valuenow="<?php print (int)($top_artist->getAverage() * 10); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print (int)($top_artist->getAverage() * 10); ?>%"></div>
			</div>
			<p class="padded">
				<a href="<?php print $top_artist->getUrl(); ?>"><?php print $top_artist; ?></a><br>
				<br>
			</p>
			<div class="row">
				<div class="col-md-12">
					<img src="./img/artists/<?php print $top_artist->getPicture(); ?>" width="100%">
				</div>
			</div>
		</p>
	</div>
</div>