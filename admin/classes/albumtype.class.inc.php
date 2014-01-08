<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class AlbumType: modelises an album type
	 * Type of recording.
	 *
	 */
	class AlbumType {
		private $id;
		private $label;
		private $description;
		
		public function __construct( $id ) {
			$id || die( "Error: Wrong album type." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$res = $this->db->query( "select * from albumType where id = $id" );
			$type = $res->fetch(PDO::FETCH_ASSOC);
			$this->id = $type['id'];
			$this->label = $type['label'];
			$this->description = $type['description'];
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

		public function getDescription() {
			return $this->description;
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setDescription( $description ) {
			$this->description = $description;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

		public static function all() {
			$db = $_SESSION['db'];
			$res = $db->query( "select id from albumType order by label;" );
			$types = array();
			while ( $type = $res->fetch(PDO::FETCH_NUM) )
				$types[] = new AlbumType( $type[0] );
			return $types;
		}
	}