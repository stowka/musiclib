<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->query( "select title from song order by title;");
	$songs = $stmt->fetchAll(PDO::FETCH_NUM);
	$s = array();
	foreach( $songs as $song )
		$s[] = $song[0];
	$stmt->closeCursor();

	print json_encode( $s );