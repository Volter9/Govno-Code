<?
	class class_db_result {
		public $data;
		
		private $mysql;
		private $query;
		public $sql;
		
		function __construct($sql,$fetch = false,$mysql,$multi = false) {
			$this->sql = $sql;
			
			$this->query = mysql_query($sql);
			
			if ($fetch) {
				$this->fetch($multi);
			}
		}
		
		function fetch($multi = false) {
			if(stripos($this->sql,"select") !== false) {
				$fetched = 0;
			
				if(mysql_num_rows($this->query) == 1 && !$multi) {
					$this->data = mysql_fetch_array($this->query,MYSQL_ASSOC);
				}
				else if(mysql_num_rows($this->query) > 0) {
					do {
						if(is_array($fetched)) {
							$this->data[] = $fetched;
						}
					} while ($fetched = mysql_fetch_array($this->query,MYSQL_ASSOC));
				}
			}
		}
	}
?>