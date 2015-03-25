<?
	class core_controller_addposter extends class_controller {
		function index() {
			$db = class_db_database::getDB();
			$db->connect("localhost","user","123456");
			$db->setBase("koto");
			
			$categories = new core_model_category();
			$categories->getAllCategories();
			
			if($this->router->global->method == 'post') {
				$this->doPOST($this->router->global->post,$this->router->global->files);
			}
			
			$template = new class_template();
			$template->set("catbar",$categories->get("data"));
			$template->render("addposter.html");
		}
		
		private function doPOST($post,$files) {
			$poster = new core_model_poster();
			$uploaded = $poster->uploadPoster($post,$files['poster']);
			
			if ($uploaded) {
				core_model_poster::addPoster($poster);
			}
		}
	}
?>