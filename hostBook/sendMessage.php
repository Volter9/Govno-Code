<?
	require("config.php");
	
	$message = new Message();
	$message->createMessageFromAssoc($_POST);
	
	$message->date = date("Y-m-d, H:i");
	
	if($message->checkEmailForRegExp("/([a-z0-9.]*)@([a-z0-9.]*)/i")) {
		$message->secureText();
		
		$sql = "INSERT INTO `messages` (`author`,`email`,`text`,`date`) VALUES ('".$message->author."','".$message->email."','".$message->text."','".$message->date."')";
		$db->query($sql,"messagesInsert");
		
		header("Location: ./");
	}
	else {
		header("Location: ./");
	}
?>