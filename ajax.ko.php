<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");



	if ( isset( $_POST["song"] ) 
	&& isset( $_SESSION['online'] ) ) {

		$db = $_SESSION['db'];

		$id_user = $_SESSION["user"]->getId();
		$id_song = $_POST["song"];
		$known = $_POST['known'] === 'true' ? true : false;
		$owned = $_POST['owned'] === 'true' ? true : false;

		if ( Know::userKnowsSong( $id_user, $id_song ) ):
			if ( $known && $owned ):
				$stmt = $db->prepare( "update know set owned = 1 where user = :user and song = :song;" );
			elseif ( $known && !$owned ):
				$stmt = $db->prepare( "update know set owned = 0 where user = :user and song = :song;" );
			else:
				$stmt = $db->prepare( "delete from know where user = :user and song = :song;" );
				$stmt2 = $db->prepare( "delete from rate where user = :user and song = :song;" );
				$stmt2->execute( array(
					"user" => $id_user,
					"song" => $id_song
				) );
				$stmt2->closeCursor();
			endif;
		else:
			if ( $owned ) :
				$stmt = $db->prepare( "insert into know values (:user, :song, 1, unix_timestamp());" );
			else:
				$stmt = $db->prepare( "insert into know values (:user, :song, 0, unix_timestamp());" );
			endif;
		endif;

		$stmt->execute( array(
			"user" => $id_user,
			"song" => $id_song
		) );

		$stmt->closeCursor();

		print json_encode( array( "status" => "OK", "stackTrace" => "alright", "known" => $_POST['known'], "owned" => $_POST['owned'] ) );
	} elseif ( !isset( $_POST['song'] ) )
		print json_encode( array( "status" => "ERROR", "stackTrace" => "song missing", "known" => $_POST['known'], "owned" => $_POST['owned'] ) );
	elseif ( !isset( $_SESSION['online'] ) )
		print json_encode( array( "status" => "ERROR", "stackTrace" => "user not connected", "known" => $_POST['known'], "owned" => $_POST['owned'] ) );