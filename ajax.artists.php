<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select name from artist order by name;");
	$stmt->execute();
	$artists = $stmt->fetchAll(PDO::FETCH_NUM);
	$a = array();
	foreach( $artists as $artist )
		$a[] = $artist[0];
	$stmt->closeCursor();

	print json_encode( $a );

