<?
	class class_db_database {
		private $mysql; // Instance of mysql
		
		const charset = 'utf8'; // Modify this line, to change charset.
		
		private $host;
		private $user;
		private $password;
		
		private $dbname;
		
		static private $inst;
		
		static public function getDB() {
			if(is_null(self::$inst)) {
				self::$inst = new self;
			}
			return self::$inst;
		}
		
		function connect($host,$user,$password) {
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			
			$this->mysql = mysql_connect($host,$user,$password);
			$this->setCharset(self::charset);
		}
		
		function setBase($dbname) {
			$this->dbname = $dbname;
			
			mysql_select_db($dbname, $this->mysql);
		}
		
		private function setCharset($charset) {
			mysql_query('set character_set_client="'.$charset.'"');
   			mysql_query('set character_set_results="'.$charset.'"');
   			mysql_query('set collation_connection="'.$charset.'" "');
		}
		
		public function query($sql,$fetch = false, $multi = false) {
			return new class_db_result($sql,$fetch,$this->mysql,$multi);
		}
		
		private function close() {
			mysql_close($this->mysql);
		}
	}
?>