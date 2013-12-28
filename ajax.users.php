<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->query( "select username from user order by username;");
	$users = $stmt->fetchAll(PDO::FETCH_NUM);
	$u = array();
	foreach( $users as $user )
		$u[] = $user[0];
	$stmt->closeCursor();
	array_walk_recursive( $u, function( &$value, $key ) {
		if ( is_string( $value ) ) {
			$value = iconv( 'windows-1252', 'utf-8', $value );
		}
	});

	print json_encode( $u );