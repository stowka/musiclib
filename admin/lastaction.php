<?php
 header("Content-Type: text/plain");

 // j'ai modifié les paths dans config.inc.php, ma base de code était un peu foireuse
require_once("../config/config.inc");



if(isset($_GET['choice']))
{
	switch($_GET['choice'])
	{
		case 1.1:
			albumnotarization();
		break;

		case 1.2:
			artistnotarization();
		break;

		case 1.3:
			lastAlbum();
		break;	
		
		case 1.4:
			lastArtist();
		break;	

		case 1.5:
			lastUser();
		break;

		case 1.51:
			setActive();
		break;

		case 1.6:
			lastConnection();
		break;;

	}
}




function albumnotarization()
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause,a.name, ar.name, u.username, n.album, n.user FROM notarizeAlbum n, user u, album a, cause c,artist ar, `release` r WHERE c.id=n.cause and n.album=a.id and ar.id=r.artist and a.id=r.album and u.id=n.user limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6].";";
	}

	$stmt->closeCursor();
	echo $data;
}


function artistnotarization()
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause, ar.name, u.username, n.artist, n.user FROM notarizeArtist n, user u, cause c,artist ar WHERE c.id=n.cause and ar.id=n.artist and u.id=n.user limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].";";
	}

	$stmt->closeCursor();
	echo $data;
}


function lastAlbum()
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT a.id, a.name, ar.name, a.releaseDate, a.uploadDate, a.uploadUser, at.label FROM album a, artist ar, `release` r,albumType at WHERE a.id=r.album and r.artist=ar.id and a.type=at.id order by a.uploadDate DESC limit 5;");
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
	echo $data;

}

function lastArtist()
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT ar.id, ar.name, ar.uploadDate, ar.uploadUser FROM artist ar order by ar.uploadDate DESC limit 5;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",";
		$tstamp = new Timestamp($row[2]);
		$udate=$tstamp->format("y-m-d");
		$data = $data.$udate.",".$row[3].";";	
	}

	$stmt->closeCursor();
	echo $data;

}

function lastUser()
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT  u.id, u.username, u.email, u.publicEmail, u.active FROM `user` u order by id DESC limit 5;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].";";
	}

	$stmt->closeCursor();
	echo $data;

}

function setActive()
{
	$res=$_GET['id'];
	$oUser = new User($res);
	$oUser->setActive();	
}


function lastConnection()
{
	$data="";
	// last() method doesn't work, i modified it;
	foreach ( Connection::last() as $connection ) :
		$id=$connection->getId();
		$user=$connection->getUser();
		$user=$user->getUsername();
		$ip=$connection->getIp();
		$date=$connection->getdate();
		$date=$date->format("y-m-d");
		$country=$connection->getCountry();
		$os=$connection->getOs();
		$browser=$connection->getBrowser();
		$data=$data.$id.",".$user.",".$ip.",".$date.",".$country.",".$os.",".$browser.";";
	endforeach;
	echo $data;

}
?>