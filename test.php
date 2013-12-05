<?php
	require_once "config/config.inc";

	$db = $_SESSION['db'];

	$u = new User( 1 );
	print_r($u->getConnectionLog());