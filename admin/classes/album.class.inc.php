<?php
	/*
	 * @author Alexis Beaujon
	 *
	 * Class Album: modelises an album
	 * Albums contains songs
	 *
	 */
	class Album {
		private $id;
		private $name;
		private $disc;
		private $releaseDate;
		private $uploadDate;
		private $uploadUser;
		private $type;

		public function __construct( $id ) {
			$id 
			|| Page::go404();
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$stmt = $this->db->prepare( "select * from album where id = ?" );
			$stmt->execute( array(
				$id
			) );
			if ( !$album = $stmt->fetch(PDO::FETCH_ASSOC) )
				Page::go404();
			$this->id = $album['id'];
			$this->name = $album['name'];
			$this->disc = $album['disc'];
			$this->releaseDate = new Timestamp( $album['releaseDate'] );
			$this->uploadDate = new Timestamp( $album['uploadDate'] );
			$this->uploadUser = new User( $album['uploadUser'] );
			$this->type = new AlbumType( $album['type'] );
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
			return './album.php?id=' . $this->id;
		}
		
		public function getName() {
			return utf8_encode( $this->name );
		}

		public function getDisc() {
			return $this->disc;
		}

		public function getReleaseDate( $format = "" ) {
			return $this->releaseDate;
		}

		public function getArtwork( $size = "mega" ) {
			return "img/albums/" . $this->id . ".jpg";
		}

		public function getMainArtist() {
			$stmt = $this->db->prepare( "select a.id from `release` r 
										inner join artist a on a.id = r.artist 
										where r.album = ? order by a.id limit 0, 1" );
			$stmt->execute( array(
				$this->id
			) );
			$artist = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return new Artist( $artist[0] );
		}

		public function getArtists( $number = -1 ) {
			$db = $_SESSION['db'];
			$artists = array();
			$stmt = $number === -1 ?
			$stmt = $this->db->prepare( "select a.id from `release` r 
										inner join artist a on a.id = r.artist 
										where r.album = :album order by a.id;" ) :
			$stmt = $this->db->prepare( "select a.id from `release` r 
										inner join artist a on a.id = r.artist 
										where r.album = :album order by a.id limit 0, :limit;" );
			$stmt->bindParam("album", $this->id, PDO::PARAM_INT);
			if ( $number !== -1 )
				$stmt->bindParam("limit", $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $artist = $stmt->fetch(PDO::FETCH_NUM) )
				$artists[] = new Artist( $artist[0] );
			$stmt->closeCursor();
			return $artists;
		}

		public function getUploadDate( $format = "" ) {
			return $this->uploadDate;
		}

		public function getUploadUser() {
			return $this->uploadUser;
		}

		public function getType() {
			return $this->type;
		}

		public function getSongs() {
			return Song::songsIncludedIn( $this->id );
		}

		public function getAverage() {
			$stmt = $this->db->prepare( "select a.id as id_album, 
									round(avg(song_average), 3) 
									as album_average
									from (
									select s.id, round(avg(r.grade), 3) 
									as song_average
									from rate r
									inner join (song s 
									inner join include i 
									on i.song = s.id
									) on r.song = s.id
									where i.album = ? 
									group by i.album
									) as album_average, album a
									inner join include i 
									on i.album = a.id
									where a.id = ?
									group by a.id;" );
			$stmt->execute( array(
				$this->id,
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[1];
		}

		public function countRaters() {
			$stmt = $this->db->prepare( "select count(r.grade) 
										from album a 
										inner join include i 
										on a.id = i.album 
										inner join rate r 
										on i.song = r.song 
										where a.id = ?" );
			$stmt->execute( array(
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[0];
		}



		public function isAgreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from notarizeAlbum where user = ? and album = ? and agreement = 1;" );
			$stmt->execute( array( 
				$u,
				$this->getId(),
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		public function isDisagreedBy( $u ) {
			$stmt = $this->db->prepare( "select count(*) from notarizeAlbum where user = ? and album = ? and agreement = 0;" );
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
			$stmt = $this->db->prepare( "update album set name = ? where id = ?;" );
			$stmt = execute( array(
				$name,
				$this->id
			) );
			$this->name = $name;
		}

		public function setDisc( $disc ) {
			$stmt = $this->db->prepare( "update album set disc = ? where id = ?;" );
			$stmt = execute( array(
				$disc,
				$this->id
			) );
			$this->disc = $disc;
		}

		public function setReleaseDate( $releaseDate ) {
			$stmt = $this->db->prepare( "update album set releaseDate = ? where id = ?;" );
			$stmt = execute( array(
				$releaseDate,
				$this->id
			) );
			$this->releaseDate = $releaseDate;
		}

		public function setType( $type ) {
			$stmt = $this->db->prepare( "update album set name = ? where id = ?;" );
			$stmt = execute( array(
				$name,
				$this->id
			) );
			$this->type = $type;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

		public static function storeArtworkFromAPI( $album, $size = "mega" ) {
			$db = $_SESSION['db'];
			$album = new Album( $album );
			$artist = $album->getMainArtist();
			$artist_name = strtr( $artist->getName(), array('.' => '', ',' => '') );
			$album_name = strtr( $album->getName(), array('.' => '', ',' => '') );
			if ( file_put_contents("img/albums/" . $album->getId() . ".jpg", file_get_contents( LastFMArtwork::getArtwork( utf8_encode( $artist_name ), utf8_encode( $album_name ), true, $size ) ) ) )
				return true;
			return false;
		}

		public static function all() {
			$db = $_SESSION['db'];
			$albums = array();
			$stmt = $db->prepare( "select id from album order by name;" );
			$stmt->execute();
			while ( $album = $stmt->fetch(PDO::FETCH_NUM) )
				$albums[] = new Album( $album[0] );
			$stmt->closeCursor();
			return $albums;
		}

		public static function random( $number = 1 ) {
			$db = $_SESSION['db'];
			$albums = array();
			$stmt = $db->prepare( "select id from album order by rand(), 1 limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $album = $stmt->fetch(PDO::FETCH_NUM) )
				$albums[] = new Album( $album[0] );
			$stmt->closeCursor();
			return $albums;
		}

		public static function top( $number = 1 ) {
			$db = $_SESSION['db'];
			$albums = array();
			$stmt = $db->prepare( "select a.id as id_album, a.name,
								round(avg(grade), 3) as album_average
								from rate r, album a,
								song s, include i
								where r.song = s.id
								and i.song = s.id
								and i.album = a.id
								group by a.id
								order by album_average desc
								limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $album = $stmt->fetch(PDO::FETCH_NUM) )
				$albums[] = new Album( $album[0] );
			$stmt->closeCursor();
			return $albums;
		}

		public static function create( $name, $disc, $releaseDate, $artwork, $user, $type ) {
			$db = $_SESSION['db'];
			$name = addslashes( htmlspecialchars( $name ) );
			$disc = (int)$disc;
			$stmt = $db->prepare( "insert into album 
								(name, disc, releaseDate, uploadDate, uploadUser, type) 
								values (:name, :disc, :releaseDate, unix_timestamp(), :user, :type)");
			$stmt->execute( array(
				"name" => $name,
				"disc" => $disc,
				"releaseDate" => $releaseDate,
				"user" => $user,
				"type" => $type
			) );
			$stmt->closeCursor();
			print "Album created:".$username; /* For testing purpose only */
		}

		public static function delete( $id ) {
			$db = $_SESSION['db'];
			# TODO
			# prepare
			# 
			$db->exec( "delete from album where id = '$id'" );
			//DELETE all song in this album ?
			print "album deleted"; /* For testing purpose only */
		}
	}
