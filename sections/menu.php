<header>
	<nav class="navbar navbar-default midnight-blue" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header midnight-blue">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./"><img src="img/logos/favicon.png" width="20px" alt="ML"> <?php print TITLE; ?></a>
		</div>

		<div class="collapse navbar-collapse midnight-blue" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="./"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<li><a href="./tops"><span class="glyphicon glyphicon-stats"></span> Tops</a></li>
				<li><a href="./rand"><span class="glyphicon glyphicon-random"></span> Random song</a></li>
			</ul>

			<?php
				if ( isset( $_SESSION['online'] )
				&& $_SESSION['online'] ) :
			?>
					<!-- CONNECTED -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="./img/users/<?php print $user->getPicture(); ?>" width="20px"> <?php print $user->getUsername(); ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="profile">Profile</a></li>
								<li><a href="add">New artist / album</a></li>
								<!-- <li><a href="search">Advanced search</a></li> -->
								<li class="divider"></li>
								<li><a href="#" onclick="javascript:$('#logout').submit();">Log out</a></li>
							</ul>
							<form method="post" id="logout">
								<input type="hidden" name="logout">
							</form>
						</li>
					</ul>
			<?php
				else :
			?>
					<!-- NOT CONNECTED -->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Sign in <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#login" data-toggle="modal" data-target="#login">Log in</a></li>
								<li class="divider"></li>
								<li><a href="#signin" data-toggle="modal" data-target="#signin">Create an account</a></li>
							</ul>
						</li>
					</ul>
			<?php
				endif;
			?>

			<form class="navbar-form navbar-right" role="search" action="result.php" method="get" id="form-search">
				<div class="form-group">
					<input type="search" name="q" id="search" class="form-control" placeholder="Music search" data-provide="typeahead" autocomplete="off" value="<?php if ( isset( $_GET['q'] ) ) print $_GET['q']; ?>" required>
				</div>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</form>
		</div>
	</nav>
</header>
<?php
	require_once "sections/modals.php";
?>