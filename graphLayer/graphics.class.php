<?
	class Point {
		public $x;
		public $y;
		
		static function point($x,$y) {
			$point = new Point($x,$y);
			
			return $point;
		}
		
		function __construct($x,$y) {
			$this->x = $x;
			$this->y = $y;
		}
	}

	class Graphics {
		protected $context;
		
		protected $bgColor;
		protected $fgColor;
		
		public $width;
		public $height;
		
		protected $data;
		
		function __construct($width, $height) {
			$this->width = $width;
			$this->height = $height;
			
			$this->context = imagecreate($this->width,$this->height);
		}
		
		function setBgColor($r,$g,$b) {
			$this->bgColor = imagecolorallocate($this->context,$r,$g,$b);
		}
		
		function setFgColor ($r,$g,$b) {
			$this->fgColor = imagecolorallocate($this->context,$r,$g,$b);
		}
		
		function drawString($coord,$str,$size = 1) {
			imagestring($this->context, $size,$coord->x, $coord->y,$str, $this->fgColor);
		}
		
		function drawEllipse($coord, $width, $height) {
			$x = $coord->x; $y = $coord->y;
			
			imageellipse($this->context, $x, $y, $width, $height, $this->fgColor);
		}
		
		function drawLine($point1,$point2) {
			$x = $point1->x; $x1 = $point2->x;
			$y = $point1->y; $y1 = $point2->y;
			
			imageline($this->context, $x, $y, $x1, $y1, $this->fgColor);
		}
		
		function render() {
			ob_start();
				imagepng($this->context);
				$this->data = ob_get_contents();
			ob_clean();
			
			echo "<img src=\"data:img/png;base64,".base64_encode($this->data)."\" />";
			// echo $this->data;
		}
		
		function fill($point) {
			imagefill($this->context,$point->x,$point->y,$this->bgColor);
		}
		
		function destroy() {
			imagedestroy($this->context);
		}
	}
?>