<?php
	/*
	 *
	 *
	 *
	 *
	 */
	abstract class Page {
		public static function go403() {
			header( "Location: 403" );
		}
		public static function go404() {
			header( "Location: 404" );
		}
	}