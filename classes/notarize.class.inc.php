<?php
	/**
	 *
	 * @author Antoine De Gieter
	 * 
	 * Class Notarize: defines if data is genuine
	 *
	 */
	abstract class Notarize {
		protected $user;
		protected $agreement;
		protected $cause;

		/*
		 * ===
		 * GETTERS
		 * ===
		 */
		public function getUser() {
			return $this->user;
		}

		public function getAgreement() {
			return $this->agreement;
		}

		public function getCause() {
			return $this->cause;
		}
	}