<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");



	if ( isset( $_POST["song"] ) 
	&& isset( $_SESSION['online'] ) ) {

		$db = $_SESSION['db'];

		$id_user = $_SESSION["user"]->getId();
		$id_song = $_POST["song"];

		if ( !isset( $_POST['remove'] )
		|| !$_POST['remove'] ):
			$grade = $_POST['grade'];

			$stmt = $db->prepare( "select count(*) from rate where user = :user and song = :song;" );
			$stmt->execute( array(
				"user" => $id_user,
				"song" => $id_song
			) );
			$isRated = $stmt->fetch(PDO::FETCH_NUM);
			$isRated = $isRated[0];
			$stmt->closeCursor();

			$stmt = $isRated ? $db->prepare( "update rate set grade = :grade, date = unix_timestamp() where user = :user and song = :song;" ) : $db->prepare( "insert into rate (user, song, grade, date) values (:user, :song, :grade, unix_timestamp());" );
			$stmt->execute( array(
				"user" => $id_user,
				"song" => $id_song,
				"grade" => $grade
			) );
		else:
			$stmt = $db->prepare( "delete from rate where user = :user and song = :song;" );
			$stmt->execute( array(
				"user" => $id_user,
				"song" => $id_song
			) );
		endif;

		$stmt->closeCursor();
		$song = new Song( $id_song );
		$average = $song->getAverage();
		$raters = $song->countRaters();

		print json_encode( array( "status" => "OK", "stackTrace" => "alright", "average" => $average, "raters" =>  $raters ) );
	} elseif ( !isset( $_POST['song'] ) )
		print json_encode( array( "status" => "ERROR", "stackTrace" => "song missing", "average" => null, "raters" =>  null ) );
	elseif ( !isset( $_SESSION['online'] ) )
		print json_encode( array( "status" => "ERROR", "stackTrace" => "user not connected", "average" => null, "raters" => null ) );