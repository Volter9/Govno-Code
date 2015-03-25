<?	
	class Page {
		public $id;
		public $title;
		public $text;
		public $footer;
		
		function createFromAssoc($array) {
			$this->id = $array['id'];
			$this->title = $array['title'];
			$this->text = $array['text'];
			$this->footer = $array['footer'];
		}
		
		function createFromArray($array) {
			$this->id = $array[0];
			$this->title = $array[1];
			$this->text = $array[2];
			$this->footer = $array[3];
		}
	}
	
	class Message {
		public $id;
		public $author;
		public $email;
		public $text;
		public $date;
		
		function checkEmailForRegExp($exp) {
			$regExp = preg_match($exp,$this->email);
			
			if ($regExp > 0) {
				return true;
			}
		}
		
		function createMessageWithArgs($author, $email, $text, $date) {
			$this->author = $author;
			$this->email = $email;
			$this->text = $text;
			$this->date = $date;
		}
		
		function secureText() {
			$this->text = htmlspecialchars(addslashes($this->text));
		}
		
		function createMessageFromAssoc($array) {
			$this->author = $array['author'];
			$this->email = $array['email'];
			$this->text = $array['text'];
			$this->date = $array['date'];
		}
		
		function createMessageFromArray($array) {
			$this->author = $array[0];
			$this->email = $array[1];
			$this->text = $array[2];
			$this->date = $array[3];
		}
	}
?>