<?php
	class DBHandler {
		protected $db_handle;

		# Define constants for the database connection
		const DB_HOST = "localhost";
		const DB_NAME = "musiclib";
		const DB_USER = "root";
		const DB_PASSWORD = "893QQY";

		public function __construct() {
			$this->connect();
			/*print "New DBHandle: ".self::DB_USER."@".self::DB_HOST.
				":".self::DB_NAME.chr(10); /* For testing purpose only */
		}

		protected function connect() {
			try {
				$pdo_options = array(
					PDO::ATTR_PERSISTENT => true,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				);
				$this->db_handle = new PDO(
					'mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, 
					self::DB_USER, 
					self::DB_PASSWORD, 
					$pdo_options
				);
				return true;
			} catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
				return false;
			}
		}

		/*
		 * ===
		 * MAGIC METHODS
		 * ===
		 */

		/**
		 * @Override
		 * Serialization
		 */
		public function __sleep() {
			return array();
		}

		/**
		 * @Override
		 * Unerialization
		 */
		public function __wakeup() {
			$this->connect();
		}

		/**
		 * @Override
		 * toString method
		 */
		public function __toString() {
			return self::DB_USER."@".self::DB_HOST.
				":".self::DB_NAME.chr(10);
		}

		public function query( $query ) {
			return $this->db_handle->query( $query );
		}

		public function exec( $query ) {
			return $this->db_handle->exec( $query );
		}

		public function prepare( $query ) {
			return $this->db_handle->prepare( $query );
		}

		public function lastInsertId() {
			return $this->db_handle->lastInsertId();
		}

		public function beginTransaction() {
			return $this->db_handle->beginTransaction();
		}

		public function commit() {
			return $this->db_handle->commit();
		}

		public function rollBack() {
			return $this->db_handle->rollBack();
		}

		/*
		public function test() {
			print "I'm alive".chr(10);
		} /* For testing purpose only */
	}
