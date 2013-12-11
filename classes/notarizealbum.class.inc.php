<?php
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 * Class NotarizeAlbum: concerns Albums
	 *
	 */
	class NotarizeAlbum extends Notarize {
		private $album;

		public function __construct( $user, $album ) {
			($user && $album) || die( "Error: Wrong album notarization." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $album );
		}

		private function fetchData( $user, $album ) {
			$stmt = $this->db->prepare( "select * from notarizealbum where user = ? and album = ?;" );
			$stmt->execute( array(
				$user,
				$album
			) );
			$notarization = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->album = new Album( $salbum );
			$this->agreement = $notarization['agreement'];
			$this->cause = new Cause( $notarization['cause'] );
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getAlbum() {
			return $this->album;
		}
	}