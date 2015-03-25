<?
	class Query {
		protected $db;
	
		protected $plainSQL;
		protected $query;
		
		protected $fetchedArray;
		protected $numRows;
		
		function __construct($query) {
			$this->db = DB::getDB();
			
			$this->plainSQL = $query;
			// print $this->plainSQL;
			$this->query = mysql_query($query);
			
			if (is_int(stripos($this->plainSQL,"select"))) {
				$this->numRows = mysql_num_rows($this->query);
			}
		}
		
		function getNumRows() {
			return $this->numRows;
		}
		
		function changeQuery($query) {
			$this->plainSQL = $query;
			$this->query = mysql_query($query);
			
			if (stripos($this->plainSQL,"select") === true) {
				$this->numRows = mysql_num_rows($this->query);
			}
		}
		
		function getArray($key = MYSQL_BOTH){
			$this->fetchedArray = mysql_fetch_array($this->query,$key);
			
			return $this->fetchedArray;
		}
	}

	class DB {
		private $mysql;
		private $query;
		
		private $queries;
		private $currentDB;
		
		private $host;
		private $dbnames;
		private $username;
		private $password;
		
		protected static $instance;
		
		private function __construct() {}
		private function __clone() {}
		private function __wakeup() {}
		
		static function getDB() {
			if (self::$instance == NULL) {
				self::$instance = new DB();
			}
			return self::$instance;
		}
		
		function init($host, $username, $password) {
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
		}
		
		function getMYSQL() {
			return $this->mysql;
		}
		
		private function setCharset() {
			mysql_query('set character_set_client="utf8"');
			mysql_query('set character_set_results="utf8"');
			mysql_query('set collation_connection="utf8_general_ci"');
		}
				
		function connect() {
			$this->mysql = mysql_connect($this->host, $this->username, $this->password);
			$this->setCharset();
		}
		
		function selectDB($dbname) {
			if (empty($this->dbnames[$dbname])) {
				$this->dbnames[$dbname] = $dbname;
			}
			if ($this->currentDB != $dbname) {
				$this->currentDB = $dbname;
			}
		
			mysql_select_db($this->dbnames[$dbname], $this->mysql);
		}
		
		function query($query,$key) {
			$this->query = new Query($query);
			$this->queries[$currentDB][$key] = $this->query;
		}
		
		function getQuery($key) {
			return $this->queries[$currentDB][$key];
		}
				
		function fetchArray($marker,$key) {
			switch ($marker) {
				case "A":
					return $this->queries[$currentDB][$key]->getArray(MYSQL_ASSOC);
				break;
				
				case "I":
					return $this->queries[$currentDB][$key]->getArray(MYSQL_NUM);
				break;
				
				case "AI":
					return $this->queries[$currentDB][$key]->getArray(MYSQL_BOTH);
				break;
				
				default:
					echo("MySQL #".mysql_errno()."ошибка:".mysql_error());
				break;
			}
		}
		
		function close() {
			mysql_close($this->mysql);
		}
	}
?>