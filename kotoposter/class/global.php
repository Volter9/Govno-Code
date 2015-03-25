<?
	class class_global {
		public $post;
		public $get;
		public $files;
		public $server;
		
		public $method;
		
		private static $inst;
		
		public static function get() {
			if(is_null(self::$inst)) {
				self::$inst = new class_global();
			}
			return self::$inst;
		}
		
		private function __construct() {
			$this->method = strtolower($_SERVER['REQUEST_METHOD']);
			
			$this->get = ($this->method == 'get' || count($_GET) > 0) ? $_GET : array();
			$this->post = ($this->method == 'post' || count($_POST) > 0) ? $_POST : array();
			$this->files = (count($_FILES) > 0) ? $_FILES : array();
			
			$this->server = (count($_SERVER) > 0) ? $_SERVER : array();
		}
	}
?>