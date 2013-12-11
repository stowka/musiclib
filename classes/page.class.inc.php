<?php
	/*
	 *
	 *
	 *
	 *
	 */
	abstract class Page {
		public static function 403() {
			header( "Location: 403" );
		}
		public static function 404() {
			header( "Location: 404" );
		}
	}