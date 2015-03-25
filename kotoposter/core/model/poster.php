<?
	class core_model_poster extends class_model {
		public function __construct($args = null) {
			parent::__construct($args);
		}
		
		public function uploadPoster($post,$file) {
			$commonInfo = $post;
			
			foreach ($post as $key => $val) {
				if(strlen($val) > 0 && !is_int($val)) {
					$commonInfo[$key] = htmlspecialchars($val);
				}
			}
			
			unset($commonInfo['submit']);
			$commonInfo["date"] = date("Y-m-d");
			
			$filename = date("Y-m-d-H-i-s")."-".$file['name'];
			
			if(is_uploaded_file($file['tmp_name'])) {
				if(preg_match("/(jpeg|png|gif)/i", $file['type'])) {
					move_uploaded_file($file['tmp_name'], PFolder.$filename);
				}
			}
			else {
				return false;
			}
			
			$commonInfo["location"] = PFolder.$filename;
			$size = @getimagesize($commonInfo["location"]);
			if(!$size) {
				return false;
			}
			
			list($width,$height) = $size;
			
			$commonInfo["width"] = $width;
			$commonInfo["height"] = $height;
			$commonInfo["size"] = filesize($commonInfo["location"]);
			
			$wh = 256;
			$mini = imagecreatetruecolor($wh,$wh);
			$color = imagecolorallocate($mini,255,255,255);
			imagefill($mini,0,0,$color);
			
			$image = null;
			
			switch($file['type']) {
				case "image/png":
					$image = imagecreatefrompng(PFolder.$filename);
				break;
				
				case "image/jpeg":
					$image = imagecreatefromjpeg(PFolder.$filename);
				break;
				
				case "image/gif":
					$image = imagecreatefromgif(PFolder.$filename);
				break;
			}
			
			$w = $wh;
			$h = $wh;
			
			$x = 0;
			$y = 0;
			
			if($width > $height) {
				$x = ceil(($width - $height)/2);
				$width = $height;
			}
			else {
				$y = ceil(($height - $width)/2);
				$height = $width;
			}
			
			imagecopyresampled($mini,$image,0,0,$x,$y,$wh,$wh,$width,$height);
			
			imagepng($mini,MPFolder.$filename,9);
			
			imagedestroy($mini);
			imagedestroy($image);
			
			$commonInfo["mini"] = MPFolder.$filename;
			
			$this->set("data",$commonInfo,true);
			
			return true;
		}
		
		public function getAllPostersByID($id) {
			$query = $this->db->query("SELECT * FROM poster WHERE category=$id",true,true);
			$this->set("posters",$query->data);
		}
		
		public static function addPoster($poster) {
			$sql = 'INSERT INTO poster ';
			$cols = '';
			$vals = '';
			
			foreach($poster->get() as $key => $val) {
				$cols .= "`$key`,";
				$vals .= "'$val',";
			}
			
			$cols = substr($cols, 0, strlen($cols)-1);
			$vals = substr($vals, 0, strlen($vals)-1);
			$sql .= '('.$cols.') VALUES ('.$vals.')';
			
			$query = class_db_database::getDB()->query($sql);
			if (mysql_errno() != "") {
				echo mysql_error();
			}
			
			header("Location: index.php?controller=category&args=".$poster->get("category"));
		}
	}
?>