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
				<textarea placeholder="Write your own comment!" maxlength="128" class="form-control" name="text" required><?php if ($song->userHasCommented($user->getId())) print new Comment( $user->getId(), $song->getId() ); ?></textarea>
			<br>
			<button class="btn btn-info btn-block"><?php print $song->userHasCommented($user->getId()) ? 'Update my comment' : 'Comment'; ?></button>
			</p>
		</form>
	</div>
	<hr>

<?php
	endif;
?>



<?php 
foreach ( $song->getComments() as $comment )
	{
?> 		
	<div class="asbestos">    			
		<div class="btn-group btn-group-sm pull-right" style="margin-top:0px;">
			<button class="btn btn-success" style="width:75px" type="button">
				 <span class="glyphicon glyphicon-thumbs-up"> 0 </span>
			</button>
			<button class="btn btn-danger" style="width:75px" type="button">
				 <span class="glyphicon glyphicon-thumbs-down"> 0 </span>
			</button>	
		</div>
		<p class="lead">
	    	<img src="img/users/<?php print $comment->getUser()->getPicture(); ?>" width="75px" style="margin-right:8px;">
	    	<?php print $comment->getUser(); ?>

	    </p>


		<blockquote>
			<p>
				<small class="text-clouds"><?php print $comment->getDate()->format( "d/m/Y H:i"); ?></small>
			</p>
			<p>
				<?php print nl2br( $comment ); ?>
			</p>
		</blockquote>

	<!-- 	<div class="progress" style="height:6px;margin-bottom :10px;">
			<div class="progress-bar progress-bar-success" style="width: 88%"></div>
			<div class="progress-bar progress-bar-danger" style="width: 12%"></div>
		</div> -->
	</div>

<?php
 	} 
?>