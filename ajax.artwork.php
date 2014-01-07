<?php
  /**
   *
   * @author Antoine Mady
   *
   */
	header( "Content-Type: text/plain" );
	require_once("config/config.inc");

	$db = $_SESSION['db'];
	$artists = explode( "%@", $_POST['artists'] );
	$artist = $artists[0]; 		// The first one is the good one!
	$album = $_POST['album'];
	
	print LastFMArtwork::getArtwork( utf8_encode( $artist ), utf8_encode( $album ), true, 'mega' );
