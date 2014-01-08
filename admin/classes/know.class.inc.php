<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class Know: modelises the relation between an User
	 * and a Song when it's known.
	 *
	 */
	class Know extends Activity {
		private $owned;
		
		public function __construct( $user, $song ) {
			($user && $song) || die( "Error: Wrong know." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $song );
		}

		public function fetchData( $user, $song ) {
			$stmt = $this->db->prepare( "select * from know where user = ? and song = ?" );
			$stmt->execute( array(
				$user,
				$song
			) );
			$type = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->song = new Song( $song );
			$this->owned = $type['owned'];
			$this->date = new Timestamp( $type['date'] );
		}

		/*
		 * ===
		 * MAGIC METHODS
		 * ===
		 */

		/**
		 * @Override
		 * toString method
		 */
		public function __toString() {
			return $this->owned;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function isOwned() {
			return $this->owned;
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setOwned( $owned ) {
			$this->owned = $owned;
		}

		public static function userKnowsSong($user, $song){
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(*) from know where user = :user and song = :song;" );
			$stmt->execute( array(
				"user" => $user,
				"song" => $song
			) );
			$know = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $know[0];
		} 

		public static function userOwnsSong($user, $song){
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(*) from know where user = :user and song = :song and owned = 1;" );
			$stmt->execute( array(
				"user" => $user,
				"song" => $song
			) );
			$know = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $know[0];
		} 
	}