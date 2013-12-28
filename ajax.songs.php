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
	array_walk_recursive( $s, function( &$value, $key ) {
		if ( is_string( $value ) ) {
			$value = iconv( 'windows-1252', 'utf-8', $value );
		}
	});

	print json_encode( $s );