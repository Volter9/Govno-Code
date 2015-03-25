<?
	include_once("config.php");
	
 	$factor = 18;
	$hue = 360/$factor;
	$saturation = 100/$factor;
	
	for ($i = 0; $i < $factor; $i++) {
		// Hue
		GPLGenerator::getInstance()->newPoint(hsv($hue*$i,100,0),hsv($hue*$i,100,100),8);
		GPLGenerator::getInstance()->newPoint(hsv($hue*$i,100,100),hsv($hue*$i,0,100),8);
	}
	
	GPLGenerator::getInstance()->newPoint(hsv(0,0,0),hsv(0,0,100),8);
	
	GPLGenerator::getInstance()->generateGPL();

?>