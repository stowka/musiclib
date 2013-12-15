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

	print json_encode( $u );