<?php
	require_once "config/config.inc";

	$song = Song::random();
	Page::goSong( $song[0]->getId() );