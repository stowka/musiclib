<?php
	$allowed_extensions = array("jpeg", "jpg", "png");
	require_once "sections/functions.php";

	# Status variables
	$_SESSION['loggedIn'] = false;
	$_SESSION['signedIn'] = false;
	$_SESSION['commentPosted'] = false;
	$_SESSION['commentUpdated'] = false;
	$_SESSION['commentDeleted'] = false;
	$_SESSION['gradeGiven'] = false;
	$_SESSION['gradeUpdated'] = false;
	$_SESSION['gradeDeleted'] = false;
	$_SESSION['messageSent'] = false;
	$_SESSION['artistAdded'] = false;
	$_SESSION['albumAdded'] = false;
	$_SESSION['errorLogin'] = false;

	$_SESSION['error'] = false;

	# Process log in
	if ( isset( $_POST['login'] ) 
	&& empty( $_POST['login'] ) 
	&& !empty( $_POST['username'] ) 
	&& !empty( $_POST['password'] ) ) :
		$user = addslashes( htmlspecialchars( $_POST['username'] ) );
		$passwd = addslashes( htmlspecialchars( $_POST['password'] ) );
		$id = User::login( $user, $passwd );
		if ( $id ):
			$_SESSION['user'] = new User( $id );
			$_SESSION['online'] = true;
			$_SESSION['loggedIn'] = true;
		else:
			$_SESSION['errorLogin'] = true;
		endif;
	endif;

	# Process log out
	if ( isset( $_POST['logout'] )
	&& empty( $_POST['logout'] ) ) :
		User::logout();
	endif;

	# Process sign in
	if ( isset( $_POST['signin'] ) 
	&& empty( $_POST['signin'] ) 
	&& !empty( $_POST['username'] ) 
	&& !empty( $_POST['email'] ) 
	&& !empty( $_POST['password'] ) 
	&& !empty( $_POST['password-confirm'] ) 
	&& $_POST['password'] === $_POST['password-confirm'] ) :
		$user = addslashes( htmlspecialchars( $_POST['username'] ) );
		$email = addslashes( htmlspecialchars( $_POST['email'] ) );
		$passwd = addslashes( htmlspecialchars( $_POST['password'] ) );
		User::create( $user, $email, $passwd );
		$_SESSION['signedIn'] = true;
	endif;

	# Process comment
	if ( isset( $_POST['comment'] )
	&& isset( $_POST['song'] )
	&& is_numeric( $_POST['song'] )
	&& isset( $_POST['text'] )
	&& !empty( $_POST['text'] )
	&& preg_match( "/[a-zA-Z0-9]/", trim( $_POST['text'] ) )
	&& isset( $_SESSION['online'] )
	&& $_SESSION['online'] ) :
		$db = $_SESSION['db'];
		$song = new Song( $_POST['song'] );
		$user_id = $_SESSION['user']->getId();
		$text = preg_replace( "/_3/", "&hearts;", htmlspecialchars( trim( preg_replace( "/<3/", "_3", $_POST['text'] ) ) ) );
		$stmt = $song->userHasCommented( $user_id ) 
		? $db->prepare( "update comment set text = :text, date = unix_timestamp() where user = :user and song = :song;" ) 
		: $db->prepare( "insert into comment (user, song, text, date) values (:user, :song, :text, unix_timestamp());" );
		$stmt->execute( array(
			"user" => $user_id,
			"song" => $song->getId(),
			"text" => $text
		) );
		$stmt->closeCursor();
		$_SESSION['commented'] = true;
	endif;

	# Process regular search
	/**
	 * @author Jérôme Boesch
	 * 
	 */
	if ( isset($_GET['q']) && (!empty( $_GET['q'])) ):
		$db = $_SESSION['db'];
		$q = htmlspecialchars( $_GET['q'] );

		$search_songs = array();
		$search_albums = array();
		$search_artists = array();
		$search_users = array();

		# Songs
		$stmt = $db->prepare( "select id from song where title like convert(_utf8 ? using utf8) collate utf8_general_ci order by title;" );
		$stmt->execute( array(
			'%'.$q.'%'
		) );

		while ($song_result = $stmt->fetch(PDO::FETCH_NUM)) {
			$search_songs[] = new Song($song_result[0]);
		}

		$stmt->closeCursor();

		# Albums
		$stmt = $db->prepare( "select id from album where name like convert(_utf8 ? using utf8) collate utf8_general_ci order by name;" );
		$stmt->execute( array(
			'%'.$q.'%'
		) );

		while ($search_albums_result = $stmt->fetch(PDO::FETCH_NUM)) {
			$search_albums[] = new Album($search_albums_result[0]);
		}

		$stmt->closeCursor();


		# Artist
		$stmt = $db->prepare( "select id from artist where name like convert(_utf8 ? using utf8) collate utf8_general_ci order by name;" );
		$stmt->execute( array(
			'%'.$q.'%'
		) );

		while ($search_artists_result = $stmt->fetch(PDO::FETCH_NUM)) {
			$search_artists[] = new Artist($search_artists_result[0]);
		}

		$stmt->closeCursor();


		# Users
		$stmt = $db->prepare( "select id from user where username like convert(_utf8 ? using utf8) collate utf8_general_ci order by username;" );
		$stmt->execute( array(
			'%'.$q.'%'
		) );

		while ($search_users_result = $stmt->fetch(PDO::FETCH_NUM)) {
			$search_users[] = new User($search_users_result[0]);
		}

		$stmt->closeCursor();

		if ((count($search_songs)+count($search_albums)+count($search_artists)+count($search_users))===1) {
				if (count($search_songs)==1):
					Page::goSong($search_songs[0]->getId());
				endif;
				if (count($search_artists)==1):
					Page::goArtist($search_artists[0]->getId());
				endif;
				if (count($search_albums)==1):
					Page::goAlbum($search_albums[0]->getId());
				endif;
				if (count($search_users)==1):
					Page::goUser($search_users[0]->getId());
				endif;
		}

	endif;
	
	/**
	 * @author Jérôme Boesch 
	 *
	 */
	if( isset( $_POST['text'] ) && isset( $_POST['reason'] ) && !empty( $_POST['text'] ) 
		&& isset( $_SESSION['online'] ) && $_SESSION['online'] 
		&& is_numeric( $_POST['reason'] ) && Reason::exists( $_POST['reason'] ) ):
		$db = $_SESSION['db'];
	
		$user = $_SESSION['user']->getId();
		$reason = $_POST['reason'];
		$text = $_POST['text'];

		$stmt = $db->prepare( "insert into message (user, text, date, reason) values (:user, :text, unix_timestamp(), :reason);" );
		$stmt->execute( array(
			':user' => $user,
			':text' => $text,
			':reason' => $reason
		) );

		$stmt->closeCursor();
		$_SESSION['messageSent'] = true;
	endif;

	# Process add artist
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 */
	if ( isset( $_POST['add_artist'] )
	&& isset ( $_POST['name'] )
	&& isset ( $_POST['biography'] )
	&& isset( $_SESSION['online'] ) 
	&& $_SESSION['online'] ):
		$picture = htmlspecialchars( $_POST['picture'] );
		$name = utf8_decode( htmlspecialchars( $_POST['name'] ) );
		$biography = utf8_decode( trim( htmlspecialchars( $_POST['biography'] ) ) );
		$picture_name = explode( ".", $_FILES["picture"]["name"] );
		$extension = end( $picture_name );

		if ( is_uploaded_file( $_FILES["picture"]["tmp_name"] ) 
		&& isset( $_FILES["picture"] ) 
		&& $_FILES["picture"]['error'] === 0 
		&& in_array( $extension, $allowed_extensions ) ):
			$picture_name = strtolower( normalize( preg_replace("/[ '\"\/]/", "", $name) ) ).'.'.$extension;
			$tmp_name = $_FILES["picture"]["tmp_name"];

			$path = "./img/artists/".$picture_name;
			move_uploaded_file( $tmp_name, $path );
			$_SESSION['artistAdded'] = true;
			Page::goArtist( Artist::create( $name, $biography, $_SESSION['user']->getId(), $picture_name ) );
		else:
			$_SESSION['error'] = true;
		endif;
	endif;

	#Process add album
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 *
	 */
	if ( isset( $_POST['album_name'] )
	&& isset( $_POST['disc'] )
	&& isset( $_POST['release_date'] )
	&& isset( $_POST['type'] ) ):
		$db = $_SESSION['db'];
	
		$album_name = utf8_decode( trim( htmlspecialchars( $_POST['album_name'] ) ) );
		$disc = utf8_decode( trim( htmlspecialchars( $_POST['disc'] ) ) );
		$release_date = strtotime ( utf8_decode( trim( htmlspecialchars( $_POST['release_date'] ) ) ) ) + 3600;
		$type = utf8_decode( trim( htmlspecialchars( $_POST['type'] ) ) );

		$stmt = $db->prepare( "insert into album (name, disc, releaseDate, uploadDate, uploadUser, type) values (:name, :disc, :rDate, unix_timestamp(), :uUser, :type);" );
		$stmt->execute( array(
			"name" => $album_name,
			"disc" => $disc,
			"rDate" => $release_date,
			"uUser" => $_SESSION['user']->getId(),
			"type" => $type,
		) );
		$stmt->closeCursor();

		$album_id = $db->lastInsertId();

		# RELEASE
		$release_artists = explode( "%@", $_POST['artists'] );
		foreach( $release_artists as $artist ):
			$stmt = $db->prepare( "select id from artist where name = ?;" );
			$stmt->execute( array(
				$artist
			) );
			$artist_id = $stmt->fetch(PDO::FETCH_NUM);
			$stmt->closeCursor();
			$artist_id = $artist_id[0];

			$stmt = $db->prepare( "insert into `release` (artist, album) values (:artist, :album);" );
			$stmt->execute( array(
				"artist" => $artist_id,
				"album" => $album_id
			) );
			$stmt->closeCursor();
		endforeach;


		# SONG
		$n = 1;
		while ( !empty( $_POST['title_' . $n] )
		&& !empty( $_POST['artists_' . $n] )
		&& !empty( $_POST['genres_' . $n] )	):
			$title = utf8_decode( trim( htmlspecialchars( $_POST['title_' . $n] ) ) );
			$stmt = $db->prepare( "insert into song (title, duration, lyrics) values (:title, 0, '');" );
			$stmt->execute( array(
				"title" => $title
			) );
			$stmt->closeCursor();

			$song_id = $db->lastInsertId();

			# INCLUDE
			$stmt = $db->prepare( "insert into include (album, song, track) values (:album, :song, :track);" );
			$stmt->execute( array(
				"album" => $album_id,
				"song" => $song_id,
				"track" => $n
			) );
			$stmt->closeCursor();


			# PERFORM
			$title_artists = explode( "%@", $_POST['artists_' . $n] );
			foreach( $title_artists as $artist ):
				$stmt = $db->prepare( "select id from artist where name = ?;" );
				$stmt->execute( array(
					$artist
				) );
				$artist_id = $stmt->fetch(PDO::FETCH_NUM);
				$stmt->closeCursor();
				$artist_id = $artist_id[0];

				$stmt = $db->prepare( "insert into perform (artist, song) values (:artist, :song);" );
				$stmt->execute( array(
					"artist" => $artist_id,
					"song" => $song_id
				) );
				$stmt->closeCursor();
			endforeach;

			# BELONG
			$title_genres = explode( "%@", $_POST['genres_' . $n] );
			foreach( $title_genres as $genre ):
				$stmt = $db->prepare( "select id from genre where label = ?;" );
				$stmt->execute( array(
					$genre
				) );
				$genre_id = $stmt->fetch(PDO::FETCH_NUM);
				$stmt->closeCursor();
				$genre_id = $genre_id[0];

				$stmt = $db->prepare( "insert into belong (song, genre) values (:song, :genre);" );
				$stmt->execute( array(
					"song" => $song_id,
					"genre" => $genre_id
				) );
				$stmt->closeCursor();
			endforeach;

			# LYRICS
			$lyrics = Song::getLyricsFromAPI( $title_artists[0], $title );
			$stmt = $db->prepare( "update song set lyrics = :lyrics where id = :id;" );
			$stmt->bindParam( "lyrics", $lyrics, PDO::PARAM_STR );
			$stmt->bindParam( "id", $song_id, PDO::PARAM_INT );
			$stmt->execute();
			$stmt->closeCursor();

			# ARTWORK
			Album::storeArtworkFromAPI( $album_id );

			# KNOWN
			$stmt = $db->prepare( "insert into know (user, song, owned, date) values (:user, :song, 0, unix_timestamp());" );
			$stmt->bindParam( "user", $_SESSION['user']->getId(), PDO::PARAM_INT );
			$stmt->bindParam( "song", $song_id, PDO::PARAM_INT );
			$stmt->execute();
			$stmt->closeCursor();

			$n++;
		endwhile;
		Page::goAlbum( $album_id );
	endif;

	# Process grade comment
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 */
	if ( isset( $_SESSION['online'] ) 
	&& (isset( $_POST['agree'] ) || isset( $_POST['disagree'] ) )
	&& isset( $_POST['userComment'] )
	&& isset( $_POST['songComment'] ) ):
		$agreement = isset( $_POST['agree'] ) ? 1 : 0;
		$user = $_SESSION['user']->getId();
		$userComment = $_POST['userComment'];
		$songComment = $_POST['songComment'];
		if ( $user != $userComment )
			GradeComment::create( $user, $userComment, $songComment, $agreement );
	endif;

	# Process notarize artist
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 */
	if ( isset( $_SESSION['online'] ) 
	&& ( isset( $_POST['agree'] ) || isset( $_POST['disagree'] ) )
	&& isset( $_POST['cause'] ) 
	&& isset( $_POST['artist'] ) ):
		$agreement = isset( $_POST['disagree'] ) ? 0 : 1;
		$user = $_SESSION['user']->getId();
		$artist = $_GET['id'];
		$cause = $_POST['cause'];
		$cause = $agreement == 1 ? 7 : $cause;
		NotarizeArtist::create( $user, $artist, $agreement, $cause );
	endif;

	# Process notarize album
	/**
	 *
	 * @author Antoine De Gieter
	 *
	 */
	if ( isset( $_SESSION['online'] ) 
	&& ( isset( $_POST['agree'] ) || isset( $_POST['disagree'] ) )
	&& isset( $_POST['cause'] ) 
	&& isset( $_POST['album'] ) ):
		$agreement = isset( $_POST['disagree'] ) ? 0 : 1;
		$user = $_SESSION['user']->getId();
		$album = $_GET['id'];
		$cause = $_POST['cause'];
		$cause = $agreement == 1 ? 7 : $cause;
		NotarizeAlbum::create( $user, $album, $agreement, $cause );
	endif;