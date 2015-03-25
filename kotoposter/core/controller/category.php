<?
	class core_controller_category extends class_controller {
		function index($args) {
			$db = class_db_database::getDB();
			$db->connect("localhost","user","123456");
			$db->setBase("koto");
			
			$categories = new core_model_category();
			$categories->getAllCategories();
			
			$category = new core_model_category();
			$category->getCategoryByID($args);
			
			$poster = new core_model_poster();
			$poster->getAllPostersByID($args);
			
			$template = new class_template();
			
			// Headers
			$headers = $category->get("data");
			
			$template->set("title",$headers['name']);
			$template->set("meta_d",$headers['description']);
			$template->set("meta_k",$headers['keyword']);
			
			$template->set("category",$headers);
			$template->set("catbar",$categories->get("data"));
			$template->set("posters",$poster->get("posters"));
			
			$template->render("category.html");
		}
	}
?>