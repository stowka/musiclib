<?php
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 * Class Reason: reason to contact the admin
	 *
	 */

	class Reason {
		private $id;
		private $reason;
		private $db;

		public function __construct( $id ) {
			$id
			|| Page::go404();
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		private function fetchData( $id ) {
			$stmt = $this->db->prepare( "select * from reason where id = ?" );
			$stmt->execute( array(
				$id
			) );
			if ( !$reason = $stmt->fetch(PDO::FETCH_ASSOC) )
				Page::go404();
			$this->id = $id;
			$this->reason = $reason['reason'];
		}

		public function getId() {
			return $this->id;
		}

		public function getReason() {
			return $this->reason;
		}

		public static function exists( $id ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(reason) from reason where id = ?" );
			$stmt->execute( array(
				$id
			) );
			$reason = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $reason[0];
		}

		public static function all() {
			$db = $_SESSION['db'];
			$reasons = array();
			$stmt = $db->prepare( "select id from reason" );
			$stmt->execute();
			while ( $reason = $stmt->fetch(PDO::FETCH_NUM) )
				$reasons[] = new Reason( $reason[0] );
			$stmt->closeCursor();
			return $reasons;
		}
	}