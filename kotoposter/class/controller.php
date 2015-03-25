<?
	abstract class class_controller {
		protected $router;
		
		public $method;
		public $actions;
		
		function __construct($router) {
			$this->actions = get_class_methods($this);
			$this->router = $router;
		}
		
		function index($args) {
			// something ToDo
			// or Silence is Gold
		}
	}
?>