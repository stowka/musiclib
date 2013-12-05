<?php
	/*
	 * @author Antoine De Gieter
	 *
	 * Class Rate: modelises the relation between an User
	 * and a Song when it's rated.
	 *
	 */
	class Rate {
		private $user;
		private $song;
		private $grade;
		private $date;
		
		public function __construct( $user, $song ) {
			($user && $song) || die( "Error: Wrong rate." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $song );
		}

		public function fetchData( $user, $song ) {
			$stmt = $this->db->prepare( "select * from rate where user = ? and song = ?" );
			$stmt->execute( array(
				$user,
				$song
			) );
			$type = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->user = new User( $user );
			$this->song = new Song( $song );
			$this->grade = $type['grade'];
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
			return $this->grade;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getUser() {
			return $this->user;
		}

		public function getSong() {
			return $this->song;
		}

		public function getGrade() {
			return $this->grade;
		}

		public function getDate() {
			return $this->date;
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setGrade( $grade ) {
			$this->grade = $grade;
		}
	}