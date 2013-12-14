<?php
	require_once "config/config.inc";

	function normalize ( $string ) {
		$table = array(
			'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
			'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
			'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
			'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
			'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
			'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
		);

		return strtr( $string, $table );
	}

	$db = $_SESSION['db'];
	
	# ARTISTS
	// $json = file_get_contents("http://ws.audioscrobbler.com/2.0/?method=library.getartists&api_key=1f7864cbbad44af1ef71c874e6e25eba&user=netprod&format=json&limit=1955");
	// $json = json_decode( $json );
	// foreach( $json->artists->artist as $artist ) {
	// 	$name = $artist->name;
	// 	$picture = get_object_vars( $artist->image[4] )["#text"];

	// 	$stmt = $db->prepare( "select count(*) from artist where name = ?" );
	// 	$stmt->execute( array(
	// 		utf8_decode( $name )
	// 	) );
	// 	$count = $stmt->fetch(PDO::FETCH_NUM);
	// 	$stmt->closeCursor();
	// 	$pictureName = preg_replace( "/[ '\"-]/", "", strtolower( normalize( $name ) ) ) . ".jpg";
	// 	$if = file_get_contents( $picture );
	// 	file_put_contents( "img/artists/" . $pictureName, $if );
	// 	if ( !$count[0] ) {
	// 		$pictureName = preg_replace( "/[ '\"-]/", "", strtolower( normalize( $name ) ) ) . ".jpg";
	// 		$if = file_get_contents( $picture );
	// 		file_put_contents( "img/artists/" . $pictureName, $if );
	// 		$stmt = $db->prepare( "insert into artist (name, biography, uploadDate, uploadUser, picture) values (:name, '', unix_timestamp(), 1, :picture);" );
	// 		$stmt->execute( array(
	// 			"name" => utf8_decode( $name ),
	// 			"picture" => $pictureName
	// 		) );
	// 		$stmt->closeCursor();
	// 	}
	// }

	# BIOGRAPHY
	// $stmt = $db->prepare( "select id, name from artist;" );
	// $stmt->execute();
	// while( $artist = $stmt->fetch(PDO::FETCH_NUM) ):
	// 	$json = file_get_contents("http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".preg_replace("/ /", "+", $artist[1])."&api_key=1f7864cbbad44af1ef71c874e6e25eba&format=json");
	// 	$json = json_decode( $json );
	// 	$bio = $json->artist->bio->content;
	// 	$lines = explode("\n", $bio);
	// 	$exclude = array();
	// 	foreach ($lines as $line) {
	// 		if (strpos($line, 'Read more about Kansas on Last.fm') !== FALSE 
	// 		|| strpos($line, 'Creative Commons By-SA') !== FALSE) {
	// 			continue;
	// 		}
	// 		$exclude[] = $line;
	// 	}
	// 	$bio = trim( implode("\n", $exclude) );
	// 	$stmt2 = $db->prepare( "update artist set biography = :biography where id = :id;" );
	// 	$stmt2->execute( array(
	// 		"biography" => $bio,
	// 		"id" => $artist[0],
	// 	) );
	// 	$stmt2->closeCursor();
	// endwhile;
	// $stmt->closeCursor();


	$stmt = $db->prepare( "select id, name from artist;" );
	$stmt->execute();
	while( $artist = $stmt->fetch(PDO::FETCH_NUM) ):
		$json = file_get_contents("http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=".preg_replace("/ /", "+", $artist[1])."&api_key=1f7864cbbad44af1ef71c874e6e25eba&format=json");
		$json = json_decode( $json );
		$bio = $json->artist->bio->content;
		$lines = explode("\n", $bio);
		$exclude = array();
		foreach ($lines as $line) {
			if (strpos($line, 'Read more about Kansas on Last.fm') !== FALSE 
			|| strpos($line, 'Creative Commons By-SA') !== FALSE) {
				continue;
			}
			$exclude[] = $line;
		}
		$bio = trim( implode("\n", $exclude) );
		$stmt2 = $db->prepare( "update artist set biography = :biography where id = :id;" );
		$stmt2->execute( array(
			"biography" => $bio,
			"id" => $artist[0],
		) );
		$stmt2->closeCursor();
	endwhile;
	$stmt->closeCursor();





