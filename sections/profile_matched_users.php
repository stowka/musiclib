<?php
	foreach ( $user->matchUsers( 3 ) as $user ):
?>
	<div class="pomegranate">
		<?php
			print '<img	src="img/users/' . $user->getPicture() . '" alt="User" class="pull-left" width="40px" style=""> ';
		?>
		<p class="padded">
			
		</p>
	</div>
<?php
	endforeach;
?>