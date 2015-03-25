<?
	require("config.php");
	
	$image = new Graphics(1000,400);
	
	$image->setBgColor(0,0,0);
	$image->setFgColor(255,255,255);
	
	$previus;
	for ($i = 0; $i <= $image->width; $i+= $image->width/20) {
		$point1 = Point::point($i,rand(0,$image->height));
		
		$image->setFgColor(0,255,0);
		$image->drawString(Point::point($point1->x,$point1->y),"(".$point1->x.",".$point1->y.")",2);
		$image->setFgColor(0,0,255);
		$image->drawLine($point1,$previus);
		
		$previus = $point1;
	}
	
	$image->render();
	
	$image->destroy();
?>
 