<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class Artist: modelises an artist
	 * Artists perform or compose songs,
	 * Artists release albums.
	 *
	 */
	class Artist {
		private $id;
		private $name;
		private $biography;
		private $uploadDate;
		private $uploadUser;
		private $picture;
		private $db;

		public function __construct( $id ) {
			$id 
			|| Page::go404();
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$stmt = $this->db->prepare( "select * from artist where id = ?" );
			$stmt->execute( array(
				$id
			) );
			if ( !$artist = $stmt->fetch(PDO::FETCH_ASSOC) )
				Page::go404();
			$this->id = $id;
			$this->name = $artist['name'];
			$this->biography = $artist['biography'];
			$this->uploadDate = new Timestamp( $artist['uploadDate'] );
			$this->uploadUser = new User( $artist['uploadUser'] );
			$this->picture = $artist['picture'];
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
			return utf8_encode( $this->name );
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
			return './artist.php?id=' . $this->id;
		}
		
		public function getName() {
			return utf8_encode( $this->name );
		}

		public function getBiography() {
			return preg_replace( "/<br \/>/", "<br><br>", nl2br( utf8_encode( $this->biography ) ) );
		}

		public function getReleaseDate( $format = "" ) {
			# TODO
			# Timestamp format
			return $this->releaseDate;
		}

		public function getPicture() {
			return $this->picture;
		}

		public function getUploadDate( $format = "" ) {
			# TODO
			# Timestamp format
			return $this->uploadDate;
		}

		public function getUploadUser() {
			return $this->uploadUser;
		}

		public function getAlbums() {
			$albums = array();
			$stmt = $this->db->prepare( "select r.album from `release` r inner join album a on r.album = a.id where r.artist = ? order by a.releaseDate desc;" );
			$stmt->execute( array(
				$this->id
			) );
			while ( $album = $stmt->fetch(PDO::FETCH_NUM) )
				$albums[] = new Album( $album[0] );
			return $albums;
		}

		public function getSongsPerformed() {
			return Song::songsPerformedBy( $this->id );
		}

		public function getSongsComposed() {
			return Song::songsComposedBy( $this->id );
		}

		public function getAverage() {
			$stmt = $this->db->prepare( "select a.id as id_artist,
										round(avg(grade), 3)  as album_average 
										from rate r, artist a,
										song s, perform p
										where r.song = s.id
										and p.song = s.id
										and p.artist = a.id
										and a.id = ?
										group by a.id;" );
			$stmt->execute( array(
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[1];
		}

		public function countRaters() {
			$stmt = $this->db->prepare( "select count(r.grade) 
										from artist a 
										inner join perform p 
										on a.id = p.artist 
										inner join rate r 
										on p.song = r.song 
										where a.id = ?;" );
			$stmt->execute( array(
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[0];
		}

		public function isAgreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from notarizeArtist where user = ? and artist = ? and agreement = 1;" );
			$stmt->execute( array( 
				$u,
				$this->getId(),
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		public function isDisagreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from notarizeArtist where user = ? and artist = ? and agreement = 0;" );
			$stmt->execute( array( 
				$u,
				$this->getId(),
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setName( $name ) {
			$stmt = $this->db->prepare( "update artist set name = ? where id = ?;" );
			$stmt = execute( array(
				$name,
				$this->id
			) );
			$this->name = $name;
		}

		public function setBiography( $biography ) {
			$stmt = $this->db->prepare( "update artist set biography = ? where id = ?;" );
			$stmt = execute( array(
				$biography,
				$this->id
			) );
			$this->biography = $biography;
		}

		public function setPicture( $picture ) {
			# TODO
			# upload
			$stmt = $this->db->prepare( "update artist set picture = ? where id = ?;" );
			$stmt = execute( array(
				$picture,
				$this->id
			) );
			$this->picture = $picture;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

		public static function all() {
			$db = $_SESSION['db'];
			$artists = array();
			$stmt = $db->prepare( "select id from artist order by name;" );
			$stmt->execute();
			while ( $artist = $stmt->fetch(PDO::FETCH_NUM) )
				$artists[] = new Artist( $artist[0] );
			$stmt->closeCursor();
			return $artists;
		}

		public static function random( $number = 1 ) {
			$db = $_SESSION['db'];
			$artists = array();
			$stmt = $db->prepare( "select id from artist order by rand(), 1 limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $artist = $stmt->fetch(PDO::FETCH_NUM) )
				$artists[] = new Artist( $artist[0] );
			$stmt->closeCursor();
			return $artists;
		}

		public static function top( $number = 1 ) {
			$db = $_SESSION['db'];
			$artists = array();
			$stmt = $db->prepare( "select a.id as id_artist, a.name,
								round(avg(grade), 3) as r1 
								from rate r, artist a, song s, perform p
								where r.song = s.id
								and p.song = s.id
								and p.artist = a.id
								group by a.id
								order by r1 desc
								limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $artist = $stmt->fetch(PDO::FETCH_NUM) )
				$artists[] = new Artist( $artist[0] );
			$stmt->closeCursor();
			return $artists;
		}

		public static function create( $name, $biography, $user, $picture ) {
			$db = $_SESSION['db'];
			$name = $name;
			$biography = $biography;
			$stmt = $db->prepare( "insert into artist 
								(name, biography, uploadDate, uploadUser, picture) 
								values (:name, :biography, unix_timestamp(), :user, :picture)");
			$stmt->execute( array(
				"name" => $name,
				"biography" => $biography,
				"user" => $user,
				"picture" => $picture
			) );
			$stmt->closeCursor();
			return $db->lastInsertId();
			/*print "Artist created:".$username; /* For testing purpose only */
		}

		public static function delete( $id ) {
			$db = $_SESSION['db'];
			# TODO
			# transaction
			# prepare
			# unlink picture
			# 
			$db->exec( "delete from artist where id = '$id'" );
			print "album deleted"; /* For testing purpose only */
		}
	}
