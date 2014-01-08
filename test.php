<?php
	require_once "config/config.inc";

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select id from song;" );
	$stmt->execute();
	while ( $s = $stmt->fetch( PDO::FETCH_NUM ) ):
		$song = new Song( $s[0] );
		$lyrics = Song::getLyricsFromAPI( $song->getMainArtist(), $song->getTitle() );
		$stmt2 = $db->prepare( "update song set lyrics = :lyrics where id = :id;" );
		$stmt2->bindParam( "lyrics", $lyrics, PDO::PARAM_STR );
		$stmt2->bindParam( "id", $s, PDO::PARAM_INT );
		if ($stmt2->execute())
			print 1;
		else
			print 0;
		$stmt2->closeCursor();
	endwhile;
	$stmt->closeCursor();