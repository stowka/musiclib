<?php
	require_once "config/config.inc";

	$db = $_SESSION['db'];

	$act = Activity::lastActivities( 1 );
	foreach ($act as $a)
		print $a . PHP_EOL;