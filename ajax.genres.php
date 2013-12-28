<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select label from genre order by label;");
	$stmt->execute();
	$genres = $stmt->fetchAll(PDO::FETCH_NUM);
	$g = array();
	foreach( $genres as $genre )
		$g[] = $genre[0];
	$stmt->closeCursor();
	array_walk_recursive( $g, function( &$value, $key ) {
		if ( is_string( $value ) ) {
			$value = iconv( 'windows-1252', 'utf-8', $value );
		}
	});

	print json_encode( $g );