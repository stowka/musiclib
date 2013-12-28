<?php
	/**
	 *
	 * @author Antoine Mady
	 *
	 */
?>
<?php 
	if(isset($_SESSION['online']) && $_SESSION['online']):
?>

	<div class="asbestos">
		<form action="" method="post">
			<p class="lead">
	    	<img src="img/users/<?php print $user->getPicture(); ?>" width="75px" style="margin-right:8px">
	    	<?php print $user->getUsername(); ?>
	    </p>
			<p>
				<input type="hidden" name="song" value="<?php print $song->getId(); ?>">
				<input type="hidden" name="comment">
				<textarea placeholder="Write your own comment!" maxlength="128" class="form-control" name="text" required><?php if ($song->userHasCommented($user->getId())) print preg_replace( "/&hearts;/", "<3", new Comment( $user->getId(), $song->getId() ) ); ?></textarea>
				<br>
				<?php 
					if ($song->userHasCommented($user->getId())): 
				?>
						<div class="row">
							<div class="col-md-6" style="padding-right:0px;">
								<button type="submit" class="btn btn-info btn-block">Update my comment</button>
							</div>
							<div class="col-md-6 text-right" style="padding-left:0px;">
								<button type="button" class="btn btn-danger btn-block" disabled>Delete my comment</button>							
							</div>
						</div>
				<?php
					else:
				?>
						<button type="submit" class="btn btn-primary btn-block">Post a comment</button>
				<?php
					endif;
				?>		
			</p>
		</form>
	</div>
	<hr>

<?php
	endif;
?>



<?php 
$n=0;
foreach ( $song->getComments() as $comment )
	{
	$n++;

?> 		
	<div class="asbestos" id="comment<?php print $comment->getUser()->getId(); ?>">   

		<?php
			if(isset($_SESSION['online']) && $_SESSION['online'] ):
		?>
		<div class="btn-group btn-group-sm pull-right" style="margin-top:0px;" >
			<form method="post" action="<?php print $song->getUrl(); ?>#comment<?php print $comment->getUser()->getId(); ?>" style="display:inline;">
				<input type="hidden" name="agree">
				<input type="hidden" name="userComment" value="<?php print $comment->getUser()->getId(); ?>">
				<input type="hidden" name="songComment" value="<?php print $comment->getSong()->getId(); ?>">
				<button name="gradeComment<?php print $comment->getUser()->getId(); ?><?php print $comment->getSong()->getId(); ?>" class="btn btn-success <?php if ( $comment->isAgreedBy( $user->getId() ) ) print 'active'; ?>" style="width:75px" type="radio" <?php print ($_SESSION['user']->getId()===$comment->getUser()->getId() || $comment->isAgreedBy( $user->getId())) ? 'disabled' : ''; ?>>
					 <span class="glyphicon glyphicon-thumbs-up"> <?php print GradeComment::countAgreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ); ?></span>
				</button>
			</form>
			<form method="post" action="<?php print $song->getUrl(); ?>#comment<?php print $comment->getUser()->getId(); ?>" style="display:inline;">
				<input type="hidden" name="disagree">
				<input type="hidden" name="userComment" value="<?php print $comment->getUser()->getId(); ?>">
				<input type="hidden" name="songComment" value="<?php print $comment->getSong()->getId(); ?>">
				<button name="gradeComment<?php print $comment->getUser()->getId(); ?><?php print $comment->getSong()->getId(); ?>" class="btn btn-danger <?php if ( $comment->isDisagreedBy( $user->getId() ) ) print 'active'; ?>" style="width:75px" type="radio" <?php print ($_SESSION['user']->getId()===$comment->getUser()->getId() || $comment->isDisagreedBy( $user->getId())) ? 'disabled' : ''; ?>>
					 <span class="glyphicon glyphicon-thumbs-down"> <?php print GradeComment::countDisagreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ); ?></span>
				</button>	
			</form>
		</div>
		<?php
			endif;
		?>

		<p class="lead">
	    	<img src="img/users/<?php print $comment->getUser()->getPicture(); ?>" width="75px" style="margin-right:8px;">
	    	<a href="<?php print $comment->getUser()->getUrl(); ?>"><?php print $comment->getUser(); ?></a>
	    </p>


		<blockquote>
			<p>
				<small class="text-clouds"><?php print $comment->getDate()->format( "d/m/Y H:i"); ?></small>
			</p>
			<p>
				<?php print nl2br( $comment ); ?>
			</p>
		</blockquote>

		<?php
			$totalGradeComment = GradeComment::countAgreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ) + GradeComment::countDisagreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() );
			$agreePercent = $totalGradeComment !== 0 ? 100 * GradeComment::countAgreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ) / $totalGradeComment : 50;
			$disagreePercent = 100 - $agreePercent;
		?>

		<div class="progress" style="height:6px;margin-bottom :10px;">
			<div class="progress-bar progress-bar-success" style="width: <?php print $agreePercent; ?>%"></div>
			<div class="progress-bar progress-bar-danger" style="width: <?php print $disagreePercent; ?>%"></div>
		</div>
	</div>

<?php
 	} 
?>