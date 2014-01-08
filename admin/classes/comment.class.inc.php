<?php
	/**
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

		private function fetchData( $user, $song ) {
			$stmt = $this->db->prepare( "select * from comment where user = ? and song = ?;" );
			$stmt->execute( array(
				$user,
				$song
			) );
			$comment = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->song = new Song( $song );
			$this->text = $comment['text'];
			$this->date = new Timestamp( $comment['date'] );
		}

		public function isAgreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from gradeComment where user = ? and userComment = ? and songComment = ? and agreement = 1;" );
			$stmt->execute( array( 
				$u,
				$this->user->getId(),
				$this->song->getId()
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		public function isDisagreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from gradeComment where user = ? and userComment = ? and songComment = ? and agreement = 0;" );
			$stmt->execute( array( 
				$u,
				$this->user->getId(),
				$this->song->getId()
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
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
			return $this->text;
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