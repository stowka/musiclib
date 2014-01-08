<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class User: modelises a user
	 * Users can log in and out,
	 * rate songs, comment songs.
	 *
	 */
	class User {
		private $id;
		private $username;
		private $email;
		private $password;
		private $publicEmail;
		private $picture;
		private $active;
		protected $db;

		public function __construct( $id ) {
			(is_numeric( $id ) 
			&& (int)$id !== 0) 
			|| Page::go404();
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		protected function fetchData( $id ) {
			$stmt = $this->db->prepare( "select * from user where id = ?" );
			$stmt->execute( array(
				$id
			) );
			if ( !$user = $stmt->fetch( PDO::FETCH_ASSOC ) )
				Page::go404();
			$stmt->closeCursor();
			$this->id = $id;
			$this->username = $user['username'];
			$this->email = $user['email'];
			$this->password = $user['password'];
			$this->publicEmail = $user['publicEmail'];
			$this->picture = $user['picture'];
			$this->active = $user['active'];
		}

		public function matchUsers( $number = 1 ) {
			$matchedUsers = array();
			$stmt = $this->db->prepare( "select u.id as user, 
									count(r.user) as ratingCount 
									from rate r 
									inner join user u 
									on u.id = r.user 
									where r.user <> ? 
									and r.grade > 5 
									and u.active = 1
									and song 
									in (
									select song 
									from rate 
									where user = ?
									and grade > 5) 
									group by r.user 
									order by ratingCount desc 
									limit 0, ?;" );
			$stmt->bindParam(1, $this->id, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->id, PDO::PARAM_INT);
			$stmt->bindParam(3, $number, PDO::PARAM_INT);
			$stmt->execute();
			while( $matchedUser = $stmt->fetch( PDO::FETCH_ASSOC) )  :
				$matchedUsers[] = array(
					"user" => new User( $matchedUser['user'] ),
					"ratingCount" => $matchedUser['ratingCount']
				);
			endwhile;
			$stmt->closeCursor();
			return $matchedUsers;
		}

		public function getConnectionLog( $number = 1 ) {
			$log = array();
			$stmt = $this->db->prepare( "select id from connection where user = :user order by date desc limit 0, :limit" );
			$stmt->bindParam(":user", $this->id, PDO::PARAM_INT);
			$stmt->bindParam(":limit", $number, PDO::PARAM_INT);
			$stmt->execute();
			while( $connection = $stmt->fetch( PDO::FETCH_NUM) )  :
				$log[] = new Connection( $connection[0] );
			endwhile;
			$stmt->closeCursor();
			return $log;
		}

		public function resetPassword( $length = 8 ) {
			$chars = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ_@%";
			$new_password = "";
			for ( $i = 0; $i < $length; $i++ )
				$new_password .= substr( $chars, mt_rand( 0, strlen( $chars ) - 1 ), 1 );
			$stmt = $this->db->prepare( "update user set password = sha1(?) where id = ?" );
			$stmt->execute( array(
				$new_password,
				$this->id
			) );
			$stmt->closeCursor();

			$mail = new PHPMailer();
			$mail->From = 'no-reply@musiclib.com';
			$mail->FromName = '[Password] Music Lib';
			$mail->AddAddress( $this->email, $this->email );
			$mail->WordWrap = 80;
			$mail->IsHTML(true);
			$mail->Subject = 'Reset password';
			$mail->Body    = '';
			$mail->AltBody = "";
			if( $mail->Send() )
				return true;
		}

		public function comment( $song, $text ) {
			$text = addslashes( htmlspecialchars( $text) );
			$stmt = $this->db->prepare( "select id from comment where song = ? and user = ?;" );
			$stmt->execute( array(
				$song,
				$this->id
			) );
			$idComment = $stmt->fetch(PDO::FETCH_NUM);
			$idComment = $idComment[0];
			$stmt->closeCursor();
			if ( !empty( $text ) ):
				if ( $idComment ):
					$stmt = $this->db->prepare("insert into comment (user, song, text, date) 
						values (?, ?, ?, unix_timestamp());");
					$stmt->execute( array(
						$this->id,
						$song,
						$text
					) );
					$stmt->closeCursor();
					return true;
				else:
					$stmt = $this->db->prepare("update comment set text = :text, date = unix_timestamp()
												where user = :user and song = :song;");
					$stmt->execute( array(
						"text" => $text,
						"user" => $this->id,
						"song" => $song,
					) );
					$stmt->closeCursor();
					return true;
				endif;
			else:
				die( "Error: Empty text." );
			endif;
		}

		public function rate( $song, $grade ) {
			# TODO
			# test if user already rated the song
			$grade = int( $grade );
			if ( $grade >= 0
			&& $grade <= 10 ) :
				$stmt = $this->db->prepare( "insert into comment (user, song, text, date) 
					values (:user, :song, :grade, unix_timestamp());" );
				$stmt->execute( array(
					"user" => $this->id,
					"song" => $song,
					"grade" => $grade
				) );
				$stmt->closeCursor();
				return true;
			else :
				die( "Error: Wrong grade." );
			endif;
		}

		public function addArtist() {
			# TODO
			# Everything
		}

		public function addAlbum() {
			# TODO
			# Everything
		}

		public function getKnownSongs() {
			return Song::songsKnownBy( $this->id );
		}

		public function getOwnedSongs() {
			return Song::songsOwnedBy( $this->id );
		}

		public function getRatedSongs( $order = "date", $number = 1 ) {
			return Song::songsRatedBy( $this->id, $order, $number );
		}

		public function getCommentedSongs( $order = "date", $number = 1 ) {
			return Song::songsCommentedBy( $this->id, $order, $number );
		}

		public function getKnownSongCount() {
			return count( Song::songsKnownBy( $this->id ) );
		}

		public function getOwnedSongCount() {
			return count( Song::songsOwnedBy( $this->id ) );
		}

		public function getRatedSongCount( $order = "date", $number = -1 ) {
			return count( Song::songsRatedBy( $this->id, $order, $number ) );
		}

		public function getCommentedSongCount( $order = "date", $number = -1 ) {
			return count( Song::songsCommentedBy( $this->id, $order, $number ) );
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
			return $this->username;
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getId() {
			return $this->id;
		}

		public function getUrl() {
			return './user.php?id=' . $this->id;
		}
		public function getUsername() {
			return $this->username;
		}

		public function getEmail() {
			return $this->email;
		}

		public function getPassword() {
			return $this->password;
		}

		public function isPublicEmail() {
			return $this->publicEmail;
		}

		public function getPicture() {
			return !empty($this->picture) ? $this->picture : "default.jpg";
		}

		public function isActive() {
			return $this->active;
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		# Avoid usage
		public function setUsername( $username ) {
			$stmt = $this->db->prepare( "update user set username = ? where id = ?;" );
			$stmt->execute( array(
				$username,
				$this->id
			) ) || die("Error: Impossible to set `username`.");
			$stmt->closeCursor();
			$this->username = $username;
		}

		public function setEmail( $email ) {
			$stmt = $this->db->prepare( "update user set email = ? where id = ?;" );
			$stmt->execute( array(
				$email,
				$this->id
			) ) || die("Error: Impossible to set `email`.");
			$stmt->closeCursor();
			$this->email = $email;
		}

		public function setPassword( $password ) {
			$stmt = $this->db->prepare( "update user set password = sha1(?) where id = ?;" );
			$stmt->execute( array(
				$password,
				$this->id
			) ) || die("Error: Impossible to set `password`.");
			$stmt->closeCursor();
			$this->password = $password;
		}

		public function setPublicEmail( $publicEmail ) {
			$publicEmail = $publicEmail ? 1 : 0;
			$stmt = $this->db->prepare( "update user set publicEmail = ? where id = ?;" );
			$stmt->execute( array(
				$publicEmail,
				$this->id
			) ) || die("Error: Impossible to set `publicEmail`.");
			$stmt->closeCursor();
			$this->publicEmail = $publicEmail;
		}

		public function setPicture( $picture ) {
			# TODO
			# handle upload
			$stmt = $this->db->prepare( "update user set picture = ? where id = ?;" );
			$stmt->execute( array(
				$picture,
				$this->id
			) ) || die("Error: Impossible to set `picture`.");
			$stmt->closeCursor();
			$this->picture = $picture;
		}

		public function setActive( $active = true ) {
			$active = $active ? 1 : 0;
			$stmt = $this->db->prepare( "update user set active = ? where id = ?;" );
			$stmt->execute( array(
				$active,
				$this->id
			) ) || die("Error: Impossible to set `active`.");
			$stmt->closeCursor();
			$this->active = $active;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

		/**
		 * returns user.id if  
		 * username and password match,
		 * 0 otherwise
		 */
		public static function login( $user, $passwd ) {
			if ( self::matchUsernamePassword( $user, $passwd ) ) :
				$id = self::getIdFromUsername( $user );
				$db = $_SESSION['db'];
				$ip = $_SERVER['REMOTE_ADDR'];

				if ( isset($_SERVER['HTTP_X_FORWARDED_FOR'])):   
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];    
				elseif ( isset($_SERVER['HTTP_CLIENT_IP'])):   
					$ip = $_SERVER['HTTP_CLIENT_IP'];   
				else:  
					$ip = $_SERVER['REMOTE_ADDR'];  
				endif; 
				
				$signature = $_SERVER['HTTP_USER_AGENT'];
			
				# OS
				if ( eregi("Win", $signature) ):
					$os = 'Microsoft Windows';
				elseif ( eregi("Android", $signature) ):
					$os = 'Android';
				elseif ( eregi("Linux", $signature) ):
					$os = 'GNU/Linux';
				elseif ( eregi("iPhone", $signature) || eregi("iPad", $signature) ):
					$os = 'iOS';
				elseif ( eregi("FreeBSD", $signature) ):
					$os = 'Free BSD';
				elseif ( eregi("Macintosh", $signature) || eregi("Mac_PowerPC", $signature) ):
					$os = 'Mac OS';
				elseif ( eregi("SunOS", $signature) ):
					$os = 'Sun OS';
				else:
					$os='Autre';
				endif;

				
				# BROWSER
				if ( eregi("IE", $signature) ):
					$browser = 'Internet Explorer';
				elseif ( eregi("Opera", $signature) ):
					$browser = 'Opera';
				elseif ( eregi("CriOS", $signature) || eregi("Chro", $signature) ):
					$browser = 'Google Chrome';
				elseif ( eregi("Safari", $signature) ):
					$browser = 'Apple Safari';
				elseif ( eregi("Mozilla", $signature) ):
					$browser = 'Mozilla Firefox';
				else:
					$browser = 'Autre';
				endif;

				# Mobile
				if ( eregi("iPhone", $signature) 
				|| eregi("Android", $signature) 
				|| eregi("iPad", $signature)) 
					$browser .= " Mobile";

				$stmt = $db->prepare( "insert into connection 
									(user, ip, date, os, browser) 
									values (?, ?, unix_timestamp(), ?, ?);" );
				$stmt->execute( array(
					$id,
					$ip,
					$os,
					$browser
				) ) || die("Error: Impossible to log the connection.");
				$stmt->closeCursor();
				return $id;
			endif;
			return 0;
		}

		public static function logout() {
			if ( isset( $_SESSION['online'] ) )
				unset( $_SESSION['online'] );
			if ( isset( $_SESSION['user'] ) )
				unset( $_SESSION['user'] );
			Page::go("index.php");
		}

		public static function getIdFromUsername( $username ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select id from user where username = ?;" );
			$stmt->execute( array(
				$username
			) );
			$id = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $id[0];
		}

		public static function getUsernameFromId( $id ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select username from user where id = ?;" );
			$stmt->execute( array(
				$id
			) );
			$username = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $username[0];
		}

		public static function checkUsername( $username ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(id) from user 
								where username = ?;" );
			$stmt->execute( array(
				$username
			) );
			$count = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $count[0];
		}

		public static function checkEmail( $email ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(id) from user where email = ?;" );
			$stmt->execute( array(
				$email
			) );
			$count = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $count[0];
		}

		public static function validateEmail( $email ) {
			$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
			if ( eregi( $exp, $email ) ):
				if( checkdnsrr( array_pop( explode( "@", $email ) ), "MX" ) ):
					return true;
				else:
					return false;
				endif;
			else:
				return false;
			endif;
		}

		public static function matchUsernamePassword( $user, $passwd ) {
			$db = $_SESSION['db'];
			$stmt = $db->prepare( "select count(id) from user 
								where username = ? 
								and password = sha1(?);" );
			$stmt->execute( array(
				$user,
				$passwd
			) )
			|| die("Error: Username and password don't match.");
			$count = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $count[0];
		}

		public static function count() {
			$db = $_SESSION['db'];
			$stmt = $db->query( "select count(id) from user;" );
			$count = $stmt->fetch( PDO::FETCH_NUM );
			$stmt->closeCursor();
			return $count[0];
		}

		public static function search( $pattern ) {
			$db = $_SESSION['db'];
			$users = array();
			$stmt = $db->prepare( "select id from user 
								where username like ?;" );
			$stmt->execute( array(
				'%'.$pattern.'%'
			) );
			foreach( $stmt as $result ):
				$users[] = $result[0];
			endforeach;
			$stmt->closeCursor();
			return $users;
		}

		public static function create( $username, $email, $password, $picture = "" ) {
			$db = $_SESSION['db'];
			!(self::checkUsername( $username ) 
			|| self::checkEmail( $email ) )
			&& self::validateEmail( $email )  
			|| die( "Error: Username or email already exists." );
			$stmt = $db->prepare( "insert into user (username, email, password, picture, active) 
								values (:username, :email, sha1(:password), :picture, 1);" );
			$stmt->execute( array(
				"username" => $username,
				"email" => $email,
				"password" => $password,
				"picture" => $picture,
			) ) 
			|| die("Error: Invalid user data.");
			$stmt->closeCursor();
			/*print "User created:".$username.chr(10); /* For testing purpose only */
			return $db->lastInsertId();
		}

		public static function delete( $id ) {
			$db = $_SESSION['db'];
			try {
				$db->beginTransaction();
				$stmt = $db->prepare( "select picture from user where id = ?" );
				$stmt->execute( array(
					$id
				) );
				$picture = $stmt->fetch( PDO::FETCH_NUM );
				$picture = $picture[0];
				$picture != "" 
				&& file_exists( "./img/users/" . $picture ) 
				&& unlink( "./img/users/" . $picture );
				$stmt = $db->prepare( "delete from user where id = ?" );
				$stmt->execute( array(
					$id
				) );
				$db->commit();
				$stmt->closeCursor();
				print "User deleted".chr(10); /* For testing purpose only */
				# self::logout();
			} catch( PDOException $e ) {
				$db->rollBack();
				$stmt->closeCursor();
				print "Error: Unexpected error.".chr(10);
				print $e->getMessage();
			}
		}
	}
