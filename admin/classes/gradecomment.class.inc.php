<?php

	/**
	 * @author Jérôme Boesch
	 *
	 * Class GradeComment: modelises the relation between a user and a comment
	 * 
	 */

	class GradeComment {

		private $user;
		private $agreement;
		private $comment;
		private $userComment;
		private $songComment;

		public function __construct($user, $userComment, $songComment) {
			($user && $userComment && $songComment ) || die (	"Error: Wrong grade comment ");
			$this->db = $_SESSION['db'];
			$this->fetchData( $user, $userComment, $songComment );


		}

		public function fetchData( $user, $userComment, $songComment ) {
				$stmt = $this->db->prepare("select agreement from gradeComment where user = :user and userComment = :userComment and songComment = :songComment");
				$stmt->execute( array(
					"user" => $user,
					"userComment" => $userComment, 
					"songComment" => $songComment
				) );
				$gradecomment = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->user = new User( $user );
				$this->comment = new Comment( $userComment, $songComment );
				$this->userComment = new User( $userComment );
				$this->songComment = new Song( $songComment );
				$this->agreement = $gradecomment['agreement'];

		}

		/*
		 * Agree, disagree	
		 *
		 */

		public function agree( $userComment, $songComment, $user ) {
			$db = $_SESSION['db'];
			$stmt = $this->db->prepare("update gradeComment set agreement = 1 where comment = ? and user = ?");
			$stmt->execute( array(
				$userComment, $songComment,
				$user
			) );
		}

		public function disagree( $userComment, $songComment, $user ) {
			$db = $_SESSION['db'];
			$stmt = $this->db->prepare("update gradeComment set agreement = 0 where comment = ? and user = ?");
			$stmt->execute( array(
				$userComment, $songComment,
				$user
			) );

		}

		/*
		 * STATIC
		 *
		 */

		public static function create( $user, $userComment, $songComment, $agreement ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from gradeComment where user = ? and userComment = ? and songComment = ?");
			$stmt->execute( array(
				$user,
				$userComment, 
				$songComment
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();


			if ( !$count ): 
				$stmt = $db->prepare("insert into gradeComment (user, userComment, songComment, agreement) values (?, ?, ?, ?);");
				$stmt->execute( array(
					$user,
					$userComment, 
					$songComment,
					$agreement
				) );
				$stmt->closeCursor();
			else:
				$stmt = $db->prepare("update gradeComment set agreement = ? where user = ? and userComment = ? and songComment = ?;");
				$stmt->execute( array(
					$agreement,
					$user,
					$userComment, 
					$songComment
				) );
				$stmt->closeCursor();
			endif;
		}

		public static function countAgreeByComment( $userComment, $songComment ){
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from gradeComment where songComment = :songComment and userComment = :userComment and agreement = 1;");
			$stmt->execute(array(
				"userComment" => $userComment,
				"songComment" => $songComment
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}

		public static function countDisagreeByComment( $userComment, $songComment ){
			$db = $_SESSION['db'];
			$stmt = $db->prepare("select count(*) from gradeComment where songComment = :songComment and userComment = :userComment and agreement = 0;");
			$stmt->execute(array(
				"userComment" => $userComment,
				"songComment" => $songComment
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$count = $count[0];
			$stmt->closeCursor();
			return $count;
		}


		/*
		 * GETTERS
		 *
		 */

		public function getUser() {
			return $this->user;
		}

		public function getUserComment() {
			return $this->userComment;
		}

		public function getSongComment() {
			return $this->songComment;
		}

		public function getAgreement() {
			return $this->agreement;
		}

	}


?>