<?
	// Downloader+.class.php
	function isURL($url) {
		if(preg_match("/(http:\/\/|https:\/\/|ftp:\/\/)([a-zA-Z0-9\.\-]{1,253})\/([a-zA-Z0-9\-\.\?\$\_\+\!\*'\(\),]*)/i",$url)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function isHTTP($url) {
		if(preg_match("/^(http:\/\/|https:\/\/)/i",$url)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function debugPre($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
	
	class Downloader {
		private $destDir; // Destination Folder
		private $fileExtns; // File Extension
		private $downloadURL; // HTML markup URL
		
		private $URLRegEXP;
		private $FilenameRegEXP;
		
		public function setFileExtension($extns) {
			$this->fileExtns = $extns;
			
			$this->URLRegEXP = "/(http:\/\/|https:\/\/)?([a-zA-Z0-9\/\.\-]*)\/[A-Za-z0-9\-\_]{1,255}\.".$extns."/i";
			$this->FilenameRegEXP = "/[A-Za-z0-9\-\_]{1,255}\.".$extns."/i";
		}
		
		public function setDestinationDirectory($dir) {
			if(!file_exists($dir) && !is_dir($dir)) {
				mkdir($dir);
			}
		
			$this->destDir = $dir;
		}
		
		public function setDownloadURL($url) {
			if(isURL($url)) {
				$this->downloadURL = $url;
			}
			else {
				die("### Downloader+ ### - Arg. isn't <b>URL</b>.");
			}
		}
		
		public function download() {
			$contents = file_get_contents($this->downloadURL);
			
			$urls;
			$files;
			
			preg_match_all($this->URLRegEXP,$contents,$urls);
			preg_match_all($this->FilenameRegEXP,$contents,$files);
			
			$baseUrl = preg_replace("/\/([a-zA-Z0-9\_]*)\.([a-zA-Z0-9\_]*)$/i","",$this->downloadURL);
			
			chdir($this->destDir);
			
			foreach ($files[0] as $key => $val) { 			
 				$file = fopen($val,"w");
 				echo $urls[0][$key]."<br/>";
 				
 				$content = file_get_contents((isHTTP($urls[0][$key]) ? $urls[0][$key] : $baseUrl.$urls[0][$key]));
 				
 				fwrite($file,$content);
 				
 				fclose($file);
 				unset($file);
 			}
			
			chdir("../");
		}
		
		function clean() {
			$files = scandir($this->destDir);
			array_shift($files);
			array_shift($files);
			
			foreach($files as $val) {
				unlink($this->destDir.$val);
			}
			
			rmdir($this->destDir);
		}
	}
?>