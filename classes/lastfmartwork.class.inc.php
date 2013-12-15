<?php
	/* http://jonjones.org.uk */

	/* Define class */
	class LastFMArtwork {
		/* Past your API key within the quotes here. This is the only thing in this file that you need to modify */
		const API_KEY = "1f7864cbbad44af1ef71c874e6e25eba";

		/* The response from last.fm will contain different sizes of artwork. This sorts that out */
		public static $sortedsizes = array("small" => 0, "medium" => 1, "large" => 2, "extralarge" => 3, "mega" => 4);

		/* Getting the artwork */
		public static function getArtwork($artist, $album, $return_image = false, $size = 'medium') {
			/* This setup displays the artwork of a specific album so we we need to pull the artist and album from the other page */
			$artist = urlencode($artist);
			$album = urlencode($album);
			/* This is the URL that will be called with the API. Don't change the artist or album here, that is defined on another page */
			$xml    = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist={$artist}&album={$album}&api_key=" . self::API_KEY;
			$xml    = @file_get_contents($xml);

			/* Image to display if no artwork was found */
			if(!$xml) {
				return 'img/albums/noartwork.png';
			}

			/* Open the XML file and go through to find the bits we want */
			$xml = new SimpleXMLElement($xml);
			$xml = $xml->album;
			$xml = $xml->image[self::$sortedsizes[$size]];

			return (!$return_image) ? $xml : $xml;
		}
	}