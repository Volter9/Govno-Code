<?
	abstract class class_getset {
		protected $vars;
		
		public function set($name,$value,$extract = false) {
			if(!is_array($value) || !$extract) {
				$this->vars[$name] = $value;
			}
			else {
				foreach ($value as $key => $content) {
					$this->vars[$key] = $content;
				}
			}
		}
		
		public function get($name = "%all%") {
			if($name == "%all%") {
				return $this->vars;
			}
			else {
				return $this->vars[$name];
			}
		}
	}
?>