<?php
	foreach ( $oUser->matchUsers( 3 ) as $matchedUser ):
		$percent = round( 100 * $matchedUser["ratingCount"] / $oUser->getRatedSongCount(), 2 );
?>
	<div class="wet-asphalt">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<?php
					print '<img	src="img/users/' . $matchedUser["user"]->getPicture() . '" alt="User" width="75px"> ';
				?>	
			</div>
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
				<p class="padded">
					<a href="<?php print $matchedUser["user"]->getUrl(); ?>"><?php print $matchedUser["user"]; ?></a><br>
				</p>	
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<h4 class="padded text-right">
					<?php
						print $percent . '%';
					?>
					<br>
					<small class="text-clouds">similar</small>
				</h4>
			</div>
		</div>
		<div class="progress" style="height:6px;margin-bottom :10px;">
			<div class="progress-bar asbestos" style="width: <?php print $percent; ?>%"></div>
			<div class="progress-bar clouds progress-bar-clouds" style="width: <?php print 100 - $percent; ?>%"></div>
		</div>
	</div>
	<div class="padded"></div>
<?php
	endforeach;
?>