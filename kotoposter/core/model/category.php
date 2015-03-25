<?php
	class core_model_category extends class_model {
		public function getAllCategories() {
			$query = $this->db->query("SELECT * FROM categories",true,true);
			$this->set("data",$query->data);
		}
	}
?>