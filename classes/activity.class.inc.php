<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Abstract Class Activity : describes an Activity (Comment, Rate, Know)
	 *
	 */
	abstract class Activity {
		protected $user;
		protected $song;
		protected $date;
		protected $db;

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
		public static function lastActivities( $user, $number = 6 ) {
			$db = $_SESSION['db'];
			$activities = array();
			$stmt = $db->prepare( "select * from (select c.user as user, null as grade, c.text as comment, null as owned, c.date as date, c.song as song from comment c
								union all
								select r.user as user, r.grade as grade, null as comment, null as owned, r.date as date, r.song as song from rate r
								union all
								select k.user as user, null as grade, null as comment, k.owned as owned, k.date as date, k.song as song from know k) as activity
								where activity.user = ?
								order by activity.date desc
								limit 0, ?;" );
			$stmt->bindParam(1, $user, PDO::PARAM_INT);
			$stmt->bindParam(2, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $activity = $stmt->fetch(PDO::FETCH_ASSOC) ):
				if ( !is_null( $activity['comment'] ) )
					$activities[] = new Comment( $activity['user'], $activity['song'] );
				elseif ( !is_null( $activity['grade'] ) )
					$activities[] = new Rate( $activity['user'], $activity['song'] );
				elseif ( !is_null( $activity['owned'] ) )
					$activities[] = new Know( $activity['user'], $activity['song'] );
				else
					$activities[] = NULL;
			endwhile;
			$stmt->closeCursor();
			return $activities;
		}

		public static function last( $number = 6 ) {
			$db = $_SESSION['db'];
			$activities = array();
			$stmt = $db->prepare( "select * from (select c.user as user, null as grade, c.text as comment, null as owned, c.date as date, c.song as song from comment c
								union all
								select r.user as user, r.grade as grade, null as comment, null as owned, r.date as date, r.song as song from rate r
								union all
								select k.user as user, null as grade, null as comment, k.owned as owned, k.date as date, k.song as song from know k) as activity
								order by activity.date desc
								limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $activity = $stmt->fetch(PDO::FETCH_ASSOC) ):
				if ( !is_null( $activity['comment'] ) )
					$activities[] = new Comment( $activity['user'], $activity['song'] );
				elseif ( !is_null( $activity['grade'] ) )
					$activities[] = new Rate( $activity['user'], $activity['song'] );
				elseif ( !is_null( $activity['owned'] ) )
					$activities[] = new Know( $activity['user'], $activity['song'] );
				else
					$activities[] = NULL;
			endwhile;
			$stmt->closeCursor();
			return $activities;
		}

		public static function compare( $activityA, $activityB ) {
			if( $activityA->getDate()->getTs() === $activityB->getDate()->getTs() )
				return 0;
			return ( $activityA->getDate()->getTs() < $activityB->getDate()->getTs() ) ? 1 : -1;
		}

		public static function sort( $activities ) {
			return usort( $activities, "Activity::compare" );
		}
	}