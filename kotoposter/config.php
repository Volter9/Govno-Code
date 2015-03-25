<?
	error_reporting(E_ALL);
	
	define("PFolder","orgpost/");
	define("MPFolder","posters/");
	
	function __autoload($class_name) {
		$new = str_replace("_", "/", $class_name);
		include_once($new.".php");
	}
?>