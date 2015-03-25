<?
	class core_controller_index extends class_controller {
		function index() {
			$db = class_db_database::getDB();
			$db->connect("localhost","user","123456");
			$db->setBase("koto");
			
			$categories = new core_model_category();
			$categories->getAllCategories();
			
			$template = new class_template();
			$template->set("catbar",$categories->get("data"));
			$template->render("index.html");
		}
	}
?>