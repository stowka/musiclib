<?php
	if ( $_SESSION['loggedIn'] ):
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
		unset( $_SESSION['loggedIn'] );
	endif;
?>

<?php
	if ( $_SESSION['errorLogin'] ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops!</strong><br>
					Something went wrong with your username or password!
				</div>
			</div>
		</div>
<?php
		unset( $_SESSION['errorLogin'] );
	endif;
?>

<?php
	if ( $_SESSION['signedIn'] ):
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
		unset( $_SESSION['signedIn'] );
	endif;
?>

<?php
	if ( $_SESSION['commentPosted'] ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Your commented has been successfully posted!</strong><br>
				</div>
			</div>
		</div>
<?php
		unset( $_SESSION['commentPosted'] );
	endif;
?>

<?php
	if ( $_SESSION['messageSent'] ):
?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Your message has been successfully sent!</strong><br>
				</div>
			</div>
		</div>
<?php
		unset( $_SESSION['messageSent'] );
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