<?php
	# Autoload classes whenever it's needed
	function __autoload($class_name) {
		if (file_exists('classes/'.strtolower($class_name).'.class.inc.php')) 
			require_once 'classes/'.strtolower($class_name).'.class.inc.php';
		else
			throw new Exception("Unable to load $class_name.");
	}

	session_start();

	if ( !isset( $_SESSION['db'] ) )
		$_SESSION['db'] = new DBHandler();

	require_once "sections/process.php";
	if ( isset( $_SESSION['online'] ) )
		$user = $_SESSION['user'];

	# Constants
	define("TITLE", "Music Lib.");