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
	array_walk_recursive( $a, function( &$value, $key ) {
		if ( is_string( $value ) ) {
			$value = iconv( 'windows-1252', 'utf-8', $value );
		}
	});

	print json_encode( $a );

