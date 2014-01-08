<?php
	/**
	 * @author Antoine Mady
	 *
	 * Class Genre: modelises a genre of a song.
	 *
	 */
	class Genre {
		private $id;
		private $label;
		
		public function __construct( $id ) {
			$id || die( "Error: Wrong genre." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$res = $this->db->query( "select * from genre where id = $id" );
			$genre = $res->fetch(PDO::FETCH_ASSOC);
			$this->id = $genre['id'];
			$this->label = $genre['label'];
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
			return $this->label;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getId() {
			return $this->id;
		}

		public function getLabel() {
			return $this->label;
		}


		/* ===
		 * STATIC METHODS
		 * ===
		 */

		public static function all() {
			$db = $_SESSION['db'];
			$res = $db->query( "select id from genre order by label;" );
			$genres = array();
			while ( $genre = $res->fetch(PDO::FETCH_NUM) )
				$genres[] = new Genre( $genre[0] );
			return $genres;
		}
	}