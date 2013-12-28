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

		public static function countAgreeByAlbum( $album ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeAlbum where album = :album and agreement = 1;");
			$stmt->execute(array(
				"album" => $album
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}

		public static function countDisagreeByAlbum( $album ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeAlbum where album = :album and agreement = 0;");
			$stmt->execute(array(
				"album" => $album
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getAlbum() {
			return $this->album;
		}

		/*
		 * ===
		 * STATIC METHODS
		 * ===
		 */
		public static function create( $user, $album, $agreement, $cause ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from notarizeAlbum where user = ? and album = ?;");
			$stmt->execute( array(
				$user,
				$album
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();


			if ( !$count ): 
				$stmt = $db->prepare("insert into notarizeAlbum (user, album, agreement, cause) values (?, ?, ?, ?);");
				$stmt->execute( array(
					$user,
					$album, 
					$agreement,
					$cause
				) );
				$stmt->closeCursor();
			else:
				$stmt = $db->prepare("update notarizeAlbum set agreement = ?, cause = ? where user = ? and album = ?;");
				$stmt->execute( array(
					$agreement,
					$cause,
					$user, 
					$album
				) );
				$stmt->closeCursor();
			endif;
		}
	}