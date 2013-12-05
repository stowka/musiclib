<?php
	if ( $loggedIn ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Hello <?php print $_SESSION['user']; ?>!</strong><br>
					Successful login!
				</div>
			</div>
		</div>
<?php
	endif;
?>

<?php
	if ( $signedIn ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Welcome <?php print $_SESSION['user']; ?>!</strong><br>
					Thanks for signing in, you must now active your account by following the link you just received by email.<br>
				</div>
			</div>
		</div>
<?php
	endif;
?>

<?php
	if ( isset( $_SESSION['online'] )
	&& $_SESSION['online'] 
	&& !$_SESSION['user']->isActive() ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning">
				    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Your account is not active yet.</strong>
					You should activate it to be able to use all the features of <?php print TITLE; ?>
				</div>
			</div>
		</div>
<?php
	endif;
?>