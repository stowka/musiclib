<?php
	/*
	 * @author Antoine De Gieter
	 *
	 * Class Comment: modelises the relation between an User
	 * and a Song when it's commented.
	 *
	 */
	class Comment extends Activity {
		private $text;
		
		public function __construct( $user, $song ) {
			($user && $song) || die( "Error: Wrong comment." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $song );
		}

		public function fetchData( $user, $song ) {
			$stmt = $this->db->prepare( "select * from comment where user = ? and song = ?;" );
			$stmt->execute( array(
				$user,
				$song
			) );
			$type = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->song = new Song( $song );
			$this->text = $type['text'];
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
			return $this->text;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getText() {
			return utf8_encode( $this->text );
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setText( $text ) {
			$this->text = $text;
		}
	}