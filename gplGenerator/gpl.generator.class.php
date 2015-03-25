<?
	function hsv($h,$s,$v) {
		return array($h,$s,$v);
	}
	
	function hsv2rgb($hsv) {
		$r; 
		$g; 
		$b;
		
		$h = $hsv[0];
		$s = $hsv[1];
		$v = $hsv[2];
		
		$i;
		
		$f;
		$p;
		$q;
		$t;
		
		$hsv[0] = max(0, min(360, $hsv[0]));
		$hsv[1] = max(0, min(100, $hsv[1]));
		$hsv[2] = max(0, min(100, $hsv[2]));
		
		$s /= 100;
		$v /= 100;
		
		if($s == 0) {
			// Achromatic (grey)
			$r = $g = $b = $v;
			return array(round($r * 255),round($g * 255),round($b * 255));
		}
		
		$h /= 60; // sector 0 to 5
		$i = floor($h);
		$f = $h - $i; // factorial part of h
		$p = $v * (1 - $s);
		$q = $v * (1 - $s * $f);
		$t = $v * (1 - $s * (1 - $f));
	
		switch($i) {
			case 0:
				$r = $v;
				$g = $t;
				$b = $p;
				break;
				
			case 1:
				$r = $q;
				$g = $v;
				$b = $p;
				break;
				
			case 2:
				$r = $p;
				$g = $v;
				$b = $t;
				break;
				
			case 3:
				$r = $p;
				$g = $q;
				$b = $v;
				break;
				
			case 4:
				$r = $t;
				$g = $p;
				$b = $v;
				break;
				
			default: // case 5:
				$r = $v;
				$g = $p;
				$b = $q;
				break;
		}
		
		return array(round($r * 255),round($g * 255),round($b * 255));
	}
	
	class GPLGenerator {
		static private $instance;
		
		static function getInstance() {
			if (is_null(self::$instance)) {
				self::$instance = new GPLGenerator();
			}
			return self::$instance;
		}
		
		private $body = "GIMP Palette
Name: %n\n";
		
		private $colors;
		private $columns;
		private $name;
		
		public function setName($name) {
			if(!empty($name)) {
				$this->name = $name;
			}
		}
		
		public function setColumns($columns) {
			if(!empty($columns) && $columns != 0) {
				$this->columns = $columns;
			}
		}
		
		public function newPoint($hsvS,$hsvE,$c) {
			$diff = array(($hsvS[0]-$hsvE[0]) / $c,
						  ($hsvS[1]-$hsvE[1]) / $c,
						  ($hsvS[2]-$hsvE[2]) / $c);
			
			for ($i = 0; $i <= $c-1; $i++) {
				$new = array(abs($hsvS[0]-abs($diff[0] * $i)),
							 abs($hsvS[1]-abs($diff[1] * $i)),
							 abs($hsvS[2]-abs($diff[2] * $i)));	
							 
				$this->colors[] = hsv2rgb($new);
			}
			
			$this->prevColor = $hsvE;
		}
		
		public function addPoint($hsv,$c) {
			$prev = $this->prevColor;
			
			$hsvS = $prev;
		
			$diff = array(($hsvS[0]-$hsv[0]) / $c,
						  ($hsvS[1]-$hsv[1]) / $c,
						  ($hsvS[2]-$hsv[2]) / $c);
			
			for ($i = 0; $i <= $c-1; $i++) {
				$new = array(abs($hsvS[0]-abs($diff[0] * $i)),
							 abs($hsvS[1]-abs($diff[1] * $i)),
							 abs($hsvS[2]-abs($diff[2] * $i))	);	
							 
				$this->colors[] = hsv2rgb($new);
			}
			
			$this->prevColor = $hsv;
		}
		
		public function clear() {
			
		}
		
		public function generateGPL() {
			$body = $this->body;
			if(!empty($this->name)) {
				$body = str_replace("%n",$this->name,$body);
			}
			else {
				echo "GPL GENERATOR: No name for this palette at line, ".__LINE__.", ".__FILE__;
				return false;
			}
			
			if($this->columns != 0) {
				$body .= "Columns: ".$this->columns."\n";
			}
			
			foreach ($this->colors as $key => $val) {
				$body .= $val[0]." ".$val[1]." ".$val[2]." untitled".$key."\n";
			}
						
			$file = fopen($this->name.".gpl","w");
			
			fwrite($file,$body);
			
			fclose($file);
		}
	}
?>