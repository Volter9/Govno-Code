<?
	abstract class class_model extends class_getset {
		protected $db;
		
		public function __construct($args = null) {
			$this->db = class_db_database::getDB();
		}
	}
?>