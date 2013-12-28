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

		

		/*
		 * ===
		 * STATIC METHODS
		 * ===
		 */
		public static function countAgreeByArtist( $artist ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeArtist where artist = :artist and agreement = 1;");
			$stmt->execute(array(
				"artist" => $artist
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}

		public static function countDisagreeByArtist( $artist ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeArtist where artist = :artist and agreement = 0;");
			$stmt->execute(array(
				"artist" => $artist
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}

		public static function create( $user, $artist, $agreement, $cause ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeArtist where user = ? and artist = ?;");
			$stmt->execute( array(
				$user,
				$artist
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();


			if ( !$count ): 
				$stmt = $db->prepare("insert into notarizeArtist (user, artist, agreement, cause) values (?, ?, ?, ?);");
				$stmt->execute( array(
					$user,
					$artist, 
					$agreement,
					$cause
				) );
				$stmt->closeCursor();
			else:
				$stmt = $db->prepare("update notarizeArtist set agreement = ?, cause = ? where user = ? and artist = ?;");
				$stmt->execute( array(
					$agreement,
					$cause,
					$user, 
					$artist
				) );
				$stmt->closeCursor();
			endif;
		}
	}