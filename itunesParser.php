<?php
	# provides a class to parse Plist XML files
	require_once "classes/PlistParser.inc";

	$parser = new plistParser();
	
	# lib.xml is the iTunes Music Library file
	$plist = $parser->parseFile(dirname(__FILE__) . "/lib.xml");
	
	# counters
	$track_count = 0;
	$played_track_count = 0;
	
	# loop through the tracks
	foreach( $plist['Tracks'] as $track ) :
		$track_count++;

		if ( isset( $track['Play Count'] ) && $track['Play Count'] > 0 ) :
			$played_track_count++;
			
			$name = isset( $track['Name'] ) 
				  ? $track['Name'] 
				  : "Untitled";
			
			$artist = isset( $track['Artist Album'] ) 
					? $track['Artist Album']
					: "Unknown Artist";
			
			$album = isset( $track['Album'] ) 
				   ? $track['Album'] 
				   : "Unknown Album";
			
			/**
			 * TO DO: store played songs in the databse
			 */
		endif;
	endforeach;

	print $track_count; /* FOR TESTING PURPOSE ONLY */
?>
