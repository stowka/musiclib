<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select id, name, picture from artist order by rand() limit 0, 4;");
	$stmt->execute();
	$artists = $stmt->fetchAll(PDO::FETCH_NUM);
	$a = array();
	foreach( $artists as $artist )
		$a[] = [$artist[0],$artist[1],$artist[2]];
	$stmt->closeCursor();


//	Link of the first (and so good) artist!

	$tmp = new Artist($a[0][0]);
	$a[4][0] = $tmp->getUrl();

	print json_encode($a);
