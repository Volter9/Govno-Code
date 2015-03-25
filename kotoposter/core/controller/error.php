<?
	class core_controller_error extends class_controller {
		function index($args) {
			$description = array(
				301 => "Moved Permanently",
				302 => "Moved Temporarily",
				404 => "Not Found",
				403 => "Forbidden",
			);
			
			$template = new class_template();
			
			if(is_int((int)$args)) {
				$template->set("error",$args);
				$template->set("desc",$description[$args]);
			}
			
			$template->render("error.html");
		}
	}
?>