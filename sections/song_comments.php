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
	<div class="asbestos">   

		<?php
			if(isset($_SESSION['online']) && $_SESSION['online'] ):
		?>
		<input id="user_comment_<?php print $n; ?>" value="<?php print $comment->getUser()->getId(); ?>" type="hidden">
		<div class="btn-group btn-group-sm pull-right" style="margin-top:0px;" >
			<button ctype="button" class="btn btn-success" id="agree_button_<?php print $n; ?>" style="width:75px" name="gc_<?php print $n; ?>" type="radio" onclick="javascript:checkGC(true,<?php print $n; ?>);" <?php print ($_SESSION['user']->getId()===$comment->getUser()->getId()) ? 'disabled' : ''; ?>>
				 <span class="glyphicon glyphicon-thumbs-up"> <?php print GradeComment::countAgreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ); ?></span>
			</button>
			<button type="button" class="btn btn-danger" id="disagree_button_<?php print $n; ?>" style="width:75px" name="gc_<?php print $n; ?>" type="radio" onclick="javascript:checkGC(false,<?php print $n; ?>);" <?php print ($_SESSION['user']->getId()===$comment->getUser()->getId()) ? 'disabled' : ''; ?>>
				 <span class="glyphicon glyphicon-thumbs-down"> <?php print GradeComment::countDisagreeByComment( $comment->getUser()->getId(), $comment->getSong()->getId() ); ?></span>
			</button>	
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