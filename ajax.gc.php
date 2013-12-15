<?php
	header( "Content-Type: application/json" );
	require_once("config/config.inc");

	if ( isset( $_POST["agree"] ) 
	&& isset( $_POST["disagree"] )
	&& isset( $_POST["songComment"] )
	&& isset( $_POST["userComment"] )
	&& isset( $_SESSION["online"] ) ) {

		$db = $_SESSION['db'];

		$user = $_SESSION["online"]->getId();
		$userComment = $_POST["userComment"];
		$songComment = $_POST["songComment"];
		$agree = $_POST['agree'] === 'true' ? true : false;
		$disagree = $_POST['disagree'] === 'true' ? true : false;

		if ( Comment::isRatedBy( $user, $userComment, $songComment ) ):
			if ( $agree && !$disagree ):
				$stmt = $db->prepare( "update gradeComment set agreement = 1 where user = :user and userComment = :userComment and songComment = :songComment;" );
			else:
				$stmt = $db->prepare( "update gradeComment set agreement = 0 where user = :user and userComment = :userComment and songComment = :songComment;" );
			endif;
		else:
			if ( !$agree && !$disagree ) :
				$stmt = $db->prepare( "delete from gradeComment where  user = :user and userComment = :userComment and songComment = :song;" );
			elseif( $agree ):
				$stmt = $db->prepare( "insert into gradeComment values (:user, :userComment, :songComment, 1)" );
			else:
				$stmt = $db->prepare( "insert into gradeComment values (:user, :userComment, :songComment, 0)" );				
			endif;
		endif;

		$stmt->execute( array(
			"user" => $user,
			"userComment" => $userComment,
			"songComment" => $songComment
		) );

		$stmt->closeCursor();

		
	}