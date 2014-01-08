<?php
	/**
	 * @author Antoine Mady
	 *
	 * Class Include: modelises the relation between a song
	 * and an album when it's include.
	 *
	 */
	class IncludedIn {
		private $song;
		private $album;
		private $track;
		
		public function __construct( $song, $album ) {
			($song && $album) || die( "Error: Wrong include." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $song, $album );
		}

		public function fetchData( $song, $album ) {
			$stmt = $this->db->prepare( "select * from include where song = ? and album = ?" );
			$stmt->execute( array(
				$song,
				$album
			) );
			$include = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->song = new Song( $song );
			$this->album = new Album( $album );
			$this->track = $include['track'];
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
			return $this->track;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getSong() {
			return $this->song;
		}

		public function getAlbum() {
			return $this->album;
		}

		public function getTrack() {
			return $this->track;
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setTrack( $track ) {
			$this->track = $track;
		}
	}