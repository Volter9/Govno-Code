<?
	class class_router {
		private $vars;
		
		const defaultController = 'index';
		const defaultAction = 'index';
		
		public function __construct() {
			$this->set("global",class_global::get());
		}
		
		public function set($name,$value) {
			$this->vars[$name] = $value;
		}
		
		public function __get($name) {
			return $this->vars[$name];
		}
		
		public function dispatch() {
			$module = (isset($this->global->get['controller'])) ? $this->secure($this->global->get['controller']) : "";
			$action = (isset($this->global->get['action'])) ? $this->secure($this->global->get['action']) : "";
			$args = (isset($this->global->get['args'])) ? $this->secure($this->global->get['args']) : "";
			
			$pattern = "core_controller_";
			$pattern .= (!empty($module)) ? $module : self::defaultController;			
			
			$controller = new $pattern($this);
			
			$controller->method = $this->global->method;
			
			if(!empty($action)) {
				if(in_array($action, $controller->actions)) {
					$controller->{$action}($args);
				}
				else {
					$controller->{self::defaultAction}($args);
				}
			}
			else {
				$controller->{self::defaultAction}($args);
			}
		}
		
		private function secure($var) {
			$newVar = $var;
			
			if (!preg_match("|([a-zA-Z0-9]+)|i", $newVar)) {
				return false;
			}
			
			return $newVar;
		}
	}
?>
