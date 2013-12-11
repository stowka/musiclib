<?php
	/*
	 * @author Antoine De Gieter
	 *
	 * Abstract Class Activity : describes an Activity (Comment, Rate, Know)
	 *
	 */
	abstract class Activity {
		private $user;
		private $song;
		private $date;
		private $db;

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
		public function getDate() {
			return $this->date;
		}

		public function isInstanceOf() {
			return get_class( $this );
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */
		public static function sort( $activityA, $activityB ) {
			if( $activityA->getDate()->getTs() === $activityB->getDate()->getTs() )
				return 0;
			return ( $activityA->getDate()->getTs() < $activityB->getDate()->getTs() ) ? 1 : -1;
		}
	}