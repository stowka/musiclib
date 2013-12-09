<?php 
	// if(isset($_SESSION['online']) && $_SESSION['online']):
?>

<div class="asbestos">
	<form>
		<p class="lead">
    	<img src="img/users/default.jpg" width="75px" style="margin-right:8px">
    	Anonymous
    </p>
		<p>
			<textarea placeholder="Write your own comment!" class="form-control"></textarea>
		<br>
		<button class="btn btn-info btn-block">Comment</button>
		</p>
	</form>
</div>

<?php
	// endif;
?>
<hr>


<?php 
	foreach ( $song->getComments() as $plop )
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
    	<img src="img/users/default.jpg" width="75px" style="margin-right:8px;">
    	<?php print $plop->getUser(); ?>
    	 <?php //print $plop->getUser()->getPicture(); ?>
    </p>


	<blockquote>
		<p>
			<small class="text-clouds">01/01/1992</small>
		</p>
		<p>
			<?php print $plop->getText(); ?>
		</p>
	</blockquote>

	<div class="progress" style="height:6px;margin-bottom :10px;">
		<div class="progress-bar progress-bar-success" style="width: 88%"></div>
		<div class="progress-bar progress-bar-danger" style="width: 12%"></div>
	</div>
</div>

	        <?php
			 	} 
			?>