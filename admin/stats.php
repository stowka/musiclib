<?php
	$db = new PDO("mysql:host=localhost;dbname=musiclib","root","893QQY");
	$stmt = $db->query("SELECT(SELECT COUNT(ar.id) FROM artist ar) as nbartist,(SELECT COUNT(al.id) FROM album al) as nbalbum,
	(SELECT count(s.id) FROM song s) as nbsong,
	(SELECT count(u.id) FROM user u) as nbuser,
	(SELECT count(distinct k.song) FROM know k) as nbknownsong,
	(SELECT count(r.song)FROM rate r) as nbrates,
	(SELECT count(c.song)FROM comment c) as nbcomment,
	(SELECT count(*) from (select nar.artist from notarizeArtist nar union all select nal.album from notarizeAlbum nal)a ) as note;" );
		
	$count = $stmt->fetch(PDO::FETCH_NUM);
	$data = $count[0] . "," . $count[1] . "," . $count[2] . "," . $count[3] . "," . $count[4] . "," . $count[5] . "," . $count[6] . "," . $count[7];
	
	$stmt->closeCursor();

	echo $data;
?>
