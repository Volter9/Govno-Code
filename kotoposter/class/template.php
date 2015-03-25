<?
	class class_template extends class_getset {
		function __construct() {
			
		}
		
		function render($template) {
			if(!empty($this->vars)) {
				extract($this->vars);
			}
			include "core/view/".$template;
		}
	}
?>