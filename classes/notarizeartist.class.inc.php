<?php
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 * Class NotarizeArtist: concerns Artists
	 *
	 */
	class NotarizeArtist extends Notarize {
		private $artist;

		public function __construct( $user, $artist ) {
			($user && $artist) || die( "Error: Wrong artist notarization." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $artist );
		}

		private function fetchData( $user, $artist ) {
			$stmt = $this->db->prepare( "select * from notarizeArtist where user = ? and artist = ?;" );
			$stmt->execute( array(
				$user,
				$artist
			) );
			$notarization = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->artist = new Artist( $sartist );
			$this->agreement = $notarization['agreement'];
			$this->cause = new Cause( $notarization['cause'] );
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getArtist() {
			return $this->artist;
		}
	}