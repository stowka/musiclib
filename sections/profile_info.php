<div class="belize-hole">
	<button class="btn btn-xs belize-hole pull-right"  data-toggle="modal" data-target="#edit-profile" title="Edit profile"><span class="glyphicon glyphicon-edit"></span></button>
		<p class="text-left">
		<img src="./img/users/<?php print $user->getPicture(); ?>" width="60%">
	</p>
	<p class="padded lead">
		<?php print $user; ?><br>
		<small>
		<?php
			if ( $user->isPublicEmail() ):
		?>
				<span class="glyphicon glyphicon-eye-open" title="E-mail is public"></span>
		<?php
			else:
		?>
				<span class="glyphicon glyphicon-eye-close" title="E-mail is private"></span>
		<?php
			endif;
		?>
		<?php print $user->getEmail(); ?><br>
		<?php print $user->getRatedSongCount(); ?> song<?php if ( $user->getRatedSongCount() > 1 ) print 's'; ?> rated<br>
		<?php print $user->getCommentedSongCount(); ?> song<?php if ( $user->getCommentedSongCount() > 1 ) print 's'; ?> commented<br>
		<?php print $user->getKnownSongCount(); ?> song<?php if ( $user->getKnownSongCount() > 1 ) print 's'; ?> known<br>
		<?php print $user->getOwnedSongCount(); ?> song<?php if ( $user->getOwnedSongCount() > 1 ) print 's'; ?> owned<br>
		</small>
	</p>

	<p class="padded">
		<a class="btn btn-info btn-block" href="add">Add artist</a>
		<a class="btn btn-info btn-block" href="add">Add album</a>
	</p>
	<hr>
	<p class="padded">
		<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#message-admin">Contact the admin</button>
		<button class="btn btn-danger btn-block">Delete account</button>
	</p>
</div>

<!-- Message admin -->
<div class="modal fade" id="message-admin" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					Message admin
				</h4>
			</div>
			<div class="modal-body">
				<form id="form-message-admin" action="" method="post">
					<input type="hidden" name="message-admin">
					<textarea class="form-control" name="text" placeholder="Write here the message you want to send to the administrator."></textarea>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" onclick="$('#form-message-admin').submit();">Send</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit profile -->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					Edit profile
				</h4>
			</div>
			<div class="modal-body">
				<form id="form-edit-profile" action="" method="post">
					<!--
						TODO DES FAMILLES !!!
					-->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success" onclick="$('#form-edit-profile').submit();">Save</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->