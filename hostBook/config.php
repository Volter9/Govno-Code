<?
	require_once("db.class.php");
	require_once("objects.php");
	
	iconv_set_encoding("input_encoding","UTF-8");
	iconv_set_encoding("output_encoding","UTF-8");
	iconv_set_encoding("internal_encoding","UTF-8");
	
	$db = DB::getDB();
	
	$db->init("localhost","root","");
	
	$db->connect();
	$db->selectDB("book");
?>