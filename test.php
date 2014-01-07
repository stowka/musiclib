<?php
	require_once "config/config.inc";

	$db = $_SESSION['db'];
	$stmt = $db->prepare( "select id from song;" );
	$stmt->execute();
	while ( $s = $stmt->fetch( PDO::FETCH_NUM ) ):
		$song = new Song( $s[0] );
		$lyrics = addslashes(Song::getLyricsFromAPI( $song->getMainArtist(), $song->getTitle() ));
		$db->exec( "update song set lyrics = '$lyrics' where id = '" . $s[0] . "';" );
	endwhile;