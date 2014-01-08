<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class Cause: cause of disagreement.
	 *
	 */
	class Cause {
		private $id;
		private $cause;
		private $db;

		public function __construct( $id ) {
			$id || die( "Error: Wrong cause." );
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		private function fetchData( $id ) {
			$stmt = $this->db->prepare( "select cause from cause where id = ?" );
			$stmt->execute( array(
				$id
			) );
			$this->id = $id;
			$cause = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$this->cause = $cause['cause'];
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
			return $this->cause;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getId() {
			return $this->id;
		}

		public function getCause() {
			return $this->cause;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */
		public static function all() {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select id from cause order by cause;" );
			$stmt->execute();
			$causes = array();
			while ( $cause = $stmt->fetch(PDO::FETCH_NUM) )
				$causes[] = new Cause( $cause[0] );
			$stmt->closeCursor();
			return $causes;
		}
	}