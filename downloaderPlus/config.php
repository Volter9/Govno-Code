<?
	include_once("downloader+.class.php");
	
	$Downloader = new Downloader();
	
	$Downloader->setFileExtension("png");
	$Downloader->setDestinationDirectory("uploads/");
	$Downloader->setDownloadURL("http://www.colorzilla.com/firefox/palettes.html");
?>