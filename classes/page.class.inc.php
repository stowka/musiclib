<?php
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 *
	 */
	abstract class Page {
		public static function go403() {
			header( "Location: 403" );
		}

		public static function go404() {
			header( "Location: 404.php" );
		}

		public static function goArtist( $id ) {
			header( "Location: artist.php?id=$id" );
		}

		public static function goAlbum( $id ) {
			header( "Location: album.php?id=$id" );
		}

		public static function goSong( $id ) {
			header( "Location: song.php?id=$id" );
		}

		public static function goUser( $id ) {
			header( "Location: user.php?id=$id" );
		}

		public static function go( $location ) {
			header( "Location: $location" );
		}
	}