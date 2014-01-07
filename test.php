<?php
	require_once "config/config.inc";

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select id from album;" );
	$stmt->execute();
	while ( $a = $stmt->fetch( PDO::FETCH_NUM ) ):
		$album = new Album( $a[0] );
		$aw = file_get_contents( $album->getArtwork() );
		file_put_contents("img/albums/" . $album->getId() . ".jpg", $aw);
		print '1';
	endwhile;