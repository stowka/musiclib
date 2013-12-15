<?php
	/**
	 * 
	 * @author Antoine De Gieter
	 *
	 * Class Picture: a picture
	 *
	 *
	 */
	class Picture {
		private $path;
		private $name;
		private $label;

		public function __construct( $name, $path = "users/", $label = "" ) {
			$this->name = $name;
			$this->path = $path;
		}

		public function display( $width =  "100%" ) {
			print '<img src="'.$this->path.$this->name.'" alt="'.$this->label.'" width="'.$width.'">';
		}

		public function getPath() {
			return $this->path;
		}

		public function getName() {
			return $this->name;
		}

		public function getLabel() {
			return $this->label;
		}

		public static function processUpload( $tmp_file ) {
			
		}

		public static function cp( $if, $of ) {

		}

		public static function mv( $if, $of ) {

		}

		public static function rm( $file ) {

		}

		public static function resize(  ) {

		}
	}