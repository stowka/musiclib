<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->query( "select name from album order by name;");
	$albums = $stmt->fetchAll(PDO::FETCH_NUM);
	$a = array();
	foreach( $albums as $album )
		$a[] = $album[0];
	$stmt->closeCursor();

	print json_encode( $a );