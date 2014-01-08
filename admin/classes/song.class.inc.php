<?php
	/**
	 * @author Antoine De Gieter
	 *
	 * Class Song: modelises a song
	 * Songs belongs to one or several albums
	 * and have one or several genstmt.
	 *
	 */
	class Song {
		private $id;
		private $title;
		private $duration; # Stored and handled in seconds
		private $lyrics;
		
		public function __construct( $id ) {
			$id || Page::go404();
			$this->db = $_SESSION['db'];
			$this->fetchData( $id );
		}

		public function fetchData( $id ) {
			$stmt = $this->db->prepare( "select * from song where id = ?" );
			$stmt->execute( array(
				$id
			) );
			if( !$song = $stmt->fetch(PDO::FETCH_ASSOC) )
				Page::go404();
			$stmt->closeCursor();
			$this->id = $song['id'];
			$this->title = $song['title'];
			$this->duration = $song['duration'];
			$this->lyrics = $song['lyrics'];
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
			return utf8_encode( $this->title );
		}

		/*
		 * ===
		 * GETTERS
		 * ===
		 */

		public function getId() {
			return $this->id;
		}
		
		public function getTitle() {
			return utf8_encode( $this->title );
		}
		
		public function getUrl() {
			return './song.php?id=' . $this->id;
		}
		
		public function getDuration( $format = "i:s" ) {
			return gmdate($format,$this->duration);
		}

		public function getLyrics() {
			return nl2br( utf8_encode( $this->lyrics ) );
		}

		public function getGenres() {
			$genres = array();
			$stmt = $this->db->prepare( "select g.id from `belong` b 
										inner join genre g
										on b.genre = g.id 
										where b.song = ?" );
			$stmt->execute( array(
				$this->id
			) );
			while ( $genre = $stmt->fetch(PDO::FETCH_NUM) )
				$genres[] = new Genre( $genre[0] );
			$stmt->closeCursor();
			return $genres;
		}

		public function userHasCommented( $user ) {
			$stmt = $this->db->prepare( "select count(*) from `comment` where song = ? and user = ?" );
			$stmt->execute( array(
				$this->id,
				$user
			) );
			$hasCommented = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $hasCommented[0];
		}

		public function getComments() {
			$comments = array();
			$stmt = $this->db->prepare( "select user from `comment` where song = ?;" );
			$stmt->execute( array(
				$this->id
			) );
			while ( $comment = $stmt->fetch(PDO::FETCH_NUM) )
				$comments[] = new Comment( $comment[0], $this->id );
			$stmt->closeCursor();
			return $comments;
		}

		public function getArtists() {
			$artists = array();
			$stmt = $this->db->prepare( "select a.id from `perform` p 
										inner join artist a on a.id = p.artist 
										where p.song = ?" );
			$stmt->execute( array(
				$this->id
			) );
			while ( $artist = $stmt->fetch(PDO::FETCH_NUM) )
				$artists[] = new Artist( $artist[0] );
			$stmt->closeCursor();
			return $artists;
		}

		public function getAlbums() {
			$albums = array();
			$stmt = $this->db->prepare( "select a.id from `include` i 
										inner join album a on a.id = i.album 
										where i.song = ?" );
			$stmt->execute( array(
				$this->id
			) );
			while ( $album = $stmt->fetch(PDO::FETCH_NUM) )
				$albums[] = new Album( $album[0] );
			$stmt->closeCursor();
			return $albums;
		}

		public function getMainAlbum() {
			$stmt = $this->db->prepare( "select a.id from `include` i 
										inner join album a on a.id = i.album 
										where i.song = ? order by a.id limit 0, 1" );
			$stmt->execute( array(
				$this->id
			) );
			$album = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return new Album( $album[0] );
		}

		public function getMainArtist() {
			$stmt = $this->db->prepare( "select a.id from `perform` p 
										inner join artist a on a.id = p.artist 
										where p.song = ? order by a.id limit 0, 1" );
			$stmt->execute( array(
				$this->id
			) );
			$artist = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return new Artist( $artist[0] );
		}

		public function getAverage() {
			$stmt = $this->db->prepare( "select round(avg(grade), 2) from rate where song = ?;" );
			$stmt->execute( array(
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[0];
		}

		public function countRaters() {
			$stmt = $this->db->prepare( "select count(grade) from rate where song = ?;" );
			$stmt->execute( array(
				$this->id
			) );
			$average = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $average[0];
		}

		public function isRatedBy( $user ) {
			$stmt = $this->db->prepare( "select count(*) from rate where user = ? and song = ?;" );
			$stmt->execute( array(
				$user,
				$this->id
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		public function isOwnedBy( $user ) {
			$stmt = $this->db->prepare( "select count(*) from know where user = ? and song = ? and owned = 1;" );
			$stmt->execute( array(
				$user,
				$this->id
			) );
			$count = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $count[0];
		}

		public function gradeBy( $user ) {
			$stmt = $this->db->prepare( "select grade from rate where user = ? and song = ?;" );
			$stmt->execute( array(
				$user,
				$this->id
			) );
			$grade = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			return $grade[0];
		}

		public function getYouTubeResults() {
			return "http://www.youtube.com/results?search_query=" . urlencode( $this->getMainArtist() ) . '+' . urlencode( $this->getTitle() );
		}

		public function getDeezerResults() {
			return "http://www.deezer.com/search/" . urlencode( $this->getMainArtist() ) . '+' . urlencode( $this->getTitle() );
		}

		// public function getItunesResults() {
		// 	return "http://www.deezer.com/search/" . urlencode( $this->getMainArtist() ) . '+' . urlencode( $this->getTitle() );
		// }

		public function getAmazonResults() {
			return "http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=" . urlencode( $this->getMainArtist() ) . '+' . urlencode( $this->getTitle() );
		}

		/*
		 * ===
		 * SETTERS
		 * ===
		 */

		public function setTitle( $title ) {
			$this->title = $title;
		}

		public function setDuration( $duration ) {
			$this->duration = $duration;
		}

		public function setLyrics( $lyrics ) {
			$this->lyrics = $lyrics;
		}

		/* ===
		 * STATIC METHODS
		 * ===
		 */

		public static function create( $title, $duration, $lyrics ) {
			$db = $_SESSION['db'];
			$title = addslashes( htmlspecialchars( $title ) );
			$lyrics = addslashes( htmlspecialchars( $lyrics ) );
			$duration = (int)$duration;
			$db->exec( "insert into song (title, duration, lyrics) values ('$title', $duration, '$lyrics');" );
			/*print "User created:".$username; /* For testing purpose only */
		}

		public static function delete( $id ) {
			$db = $_SESSION['db'];
			# TODO
			# transaction
			# prepare
			# unlink artwork
			# 
			$db->exec( "delete from song where id = '$id'" );
			/*print "Song deleted"; /* For testing purpose only */
		}

		public static function songsPerformedBy( $artist ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->query( "select s.id from song s 
								inner join perform p 
								on s.id = p.song 
								where p.artist = $artist;" );
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			return $songs;
		}

		public static function songsComposedBy( $artist ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->query( "select s.id from song s 
								inner join compose c 
								on s.id = c.song 
								where c.artist = $artist;" );
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			return $songs;
		}

		public static function songsIncludedIn( $album ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->prepare( "select s.id from song s 
								inner join include i 
								on s.id = i.song 
								where i.album = ?
								order by i.track;" );
			$stmt->execute( array(
				$album
			) );
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			$stmt->closeCursor();
			return $songs;
		}

		public static function songsKnownBy( $user ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->prepare( "select s.id from song s 
								inner join know k 
								on s.id = k.song 
								where k.user = ?;" );
			$stmt->execute( array(
				$user
			) );
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			$stmt->closeCursor();
			return $songs;
		}

		public static function songsOwnedBy( $user ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->prepare( "select s.id from song s 
								inner join know k 
								on s.id = k.song 
								where k.user = ?
								and k.owned = 1;" );
			$stmt->execute( array(
				$user
			) );
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			$stmt->closeCursor();
			return $songs;
		}

		public static function songsRatedBy( $user, $order = "date", $number = -1 ) {
			$db = $_SESSION['db'];
			$rates = array();
			$stmt = $number === -1 ?
			$db->prepare( "select song from rate where user = :user order by :order desc;" ) :
			$db->prepare( "select song from rate where user = :user order by :order desc limit 0, :limit;" );
			$stmt->bindParam("user", $user, PDO::PARAM_STR);
			$stmt->bindParam("order", $order, PDO::PARAM_STR);
			if ( $number !== -1 ) 
				$stmt->bindParam("limit", $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $rate = $stmt->fetch(PDO::FETCH_NUM) )
				$rates[] = new Rate( $user, $rate[0] );
			$stmt->closeCursor();
			return $rates;
		}


		public static function songsCommentedBy( $user, $order = "date", $number = -1 ) {
			$db = $_SESSION['db'];
			$comments = array();
			$stmt = $number === -1 ?
			$stmt = $db->prepare( "select song from comment where user = :user order by :order desc;" ) :
			$stmt = $db->prepare( "select song from comment where user = :user order by :order desc limit 0, :limit;" );
			$stmt->bindParam("user", $user, PDO::PARAM_STR);
			$stmt->bindParam("order", $order, PDO::PARAM_STR);
			if ( $number !== -1 ) 
				$stmt->bindParam("limit", $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $comment = $stmt->fetch(PDO::FETCH_NUM) )
				$comments[] = new Comment( $user, $comment[0] );
			$stmt->closeCursor();
			return $comments;
		}

		public static function top( $number = 1 ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->prepare( "select s.id, s.title, round(avg(r.grade), 3) as song_average
								from rate r, song s
								where r.song = s.id
								group by s.id
								order by song_average desc
								limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			$stmt->closeCursor();
			return $songs;
		}

		public static function random( $number = 1 ) {
			$db = $_SESSION['db'];
			$songs = array();
			$stmt = $db->prepare( "select id from song order by rand(), 1 limit 0, ?;" );
			$stmt->bindParam(1, $number, PDO::PARAM_INT);
			$stmt->execute();
			while ( $song = $stmt->fetch(PDO::FETCH_NUM) )
				$songs[] = new Song( $song[0] );
			$stmt->closeCursor();
			return $songs;
		}
		
		/**
		 *
		 * @author Alexandre Cerniaut
		 *
		 *
		 */
		public static function getLyricsFromAPI( $artist, $title ) {
			$artist = strtolower( preg_replace("/ /", "+", $artist) );
			$title = strtolower( preg_replace("/ /", "+", $title) );
			$lyrics = file_get_contents('http://api.ntag.fr/lyrics/?artist=' . $artist . '&title=' . $title);
			return preg_replace( "/Ad$/", "", preg_replace( "/^Ad/", "", $lyrics ) );
		}
	}
