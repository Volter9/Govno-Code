<?
	abstract class class_singleton {
		static protected $instance;
		
		public static function get() {
			if(is_null(self::$instance)) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		private function __construct() {
			
		}
		
		private function __clone() {
			
		}
	}
?>