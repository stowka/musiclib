<?php
header("Content-Type: text/plain");	
require_once("../config/config.inc");


function convertToUTF8($str) {
    $enc = mb_detect_encoding($str);

    if ($enc && $enc !== 'UTF-8') {
        return iconv($enc, 'UTF-8', $str);
    } else {
        return $str;
    }
}


//partie affichage

if(isset($_GET['choice']) && $_GET['choice']=='1')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause,a.name, ar.name, u.username, n.album, n.user 
						FROM notarizeAlbum n, user u, album a, cause c,artist ar, `release` r 
						WHERE c.id=n.cause 
						and n.album=a.id
					    and ar.id=r.artist 
					    and a.id=r.album 
					    and u.id=n.user 
					    limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}




if(isset($_GET['choice']) && $_GET['choice']=='2')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause, ar.name, u.username, n.artist, n.user 
						FROM notarizeArtist n, user u, cause c,artist ar 
						WHERE c.id=n.cause 
						and ar.id=n.artist 
						and u.id=n.user 
						limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}




if(isset($_GET['action']) && $_GET['action']=='artist')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT ar.id, ar.name, ar.uploadDate, ar.uploadUser 
						FROM artist ar 
						order by ar.uploadDate 
						DESC;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",";
		$tstamp = new Timestamp($row[2]);
		$udate=$tstamp->format("y-m-d");
		$data = $data.$udate.",".$row[3].";";	
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}


if(isset($_GET['action']) && $_GET['action']=='album')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT a.id, a.name, ar.name, a.releaseDate, a.uploadDate, a.uploadUser, at.label 
						FROM album a, artist ar, `release` r,albumType at 
						WHERE a.id=r.album 
						and r.artist=ar.id 
						and a.type=at.id 
						order by a.uploadDate 
						DESC;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2];
		$tstamp1 = new Timestamp($row[3]);
		$rdate=$tstamp1->format("y-m-d");
		$tstamp2 = new Timestamp($row[4]);
		$udate=$tstamp2->format("y-m-d");
		$data=$data.",".$rdate.",".$udate.",".$row[5].",".$row[6].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}

if(isset($_GET['action']) && $_GET['action']=='song')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT s.id, s.title, s.duration, ar.name, a.name
						FROM song s, perform p, artist ar, album a, include i
						WHERE s.id = i.song
						AND i.album = a.id
						AND s.id = p.song
						AND p.artist = ar.id
						ORDER BY s.title
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}

if(isset($_GET['action']) && $_GET['action']=='albumtype')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT at.id,at.label,at.description
						FROM albumType at
						ORDER BY at.label
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}


if(isset($_GET['action']) && $_GET['action']=='genre')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT g.id,g.label
						FROM genre g
						ORDER BY g.label
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}

if(isset($_GET['action']) && $_GET['action']=='user')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT  u.id, u.username, u.email, u.publicEmail, u.active 
						FROM `user` u 
						order by id ;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].";";
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}


if(isset($_GET['action']) && $_GET['action']=='known')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT s.title, u.username, k.owned, k.date
						FROM song s, user u, know k
						WHERE k.song = s.id
						AND k.user = u.id
						ORDER BY k.date DESC 
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",";
		$tstamp = new Timestamp($row[3]);
		$date=$tstamp->format("y-m-d");
		$data = $data.$date.";";	
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}

if(isset($_GET['action']) && $_GET['action']=='rate')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT s.title, u.username, r.grade, r.date
						FROM song s, user u, rate r
						WHERE r.song = s.id
						AND r.user = u.id
						ORDER BY r.date DESC 
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",";	
		$tstamp = new Timestamp($row[3]);
		$date=$tstamp->format("y-m-d");
		$data = $data.$date.";";	
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}

if(isset($_GET['action']) && $_GET['action']=='comment')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT s.title, u.username, c.text, c.date,c.user,c.song
						FROM song s, user u, comment c
						WHERE c.song = s.id
						AND c.user = u.id
						ORDER BY c.date DESC 
						LIMIT 0 , 30");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",";	
		$tstamp = new Timestamp($row[3]);
		$date=$tstamp->format("y-m-d");
		$data = $data.$date.",".$row[4].",".$row[5].";";	
	}

	$stmt->closeCursor();
	$data=convertToUTF8($data);
	echo $data;
}


//partie suppression 


if(isset($_GET['action']) && $_GET['action']==1)
{
	$notarizealbum = new Notarizealbum($_GET['user'],$_GET['id']);
	$notarizealbum->delete($_GET['user'],$_GET['id']);
}



if(isset($_GET['action']) && $_GET['action']==2)
{
	$notarizeartist = new Notarizeartist($_GET['user'],$_GET['id']);
	$notarizeartist->delete($_GET['user'],$_GET['id']);
}

if(isset($_GET['action']) && $_GET['action']==3)
{
	$comment = new Comment($_GET['user'],$_GET['id']);
	$comment->delete($_GET['user'],$_GET['id']);
}


if(isset($_GET['type']) && $_GET['type']=='artist')
{
	$artist = new Artist($_GET['id']);
	$artist->delete($_GET['id']);
}

if(isset($_GET['type']) && $_GET['type']=='album')
{
	$album = new Album($_GET['id']);
	$album->delete($_GET['id']);
}

if(isset($_GET['type']) && $_GET['type']=='song')
{
	$song = new Song($_GET['id']);
	$song->delete($_GET['id']);
}




?>