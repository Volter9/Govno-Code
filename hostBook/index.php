<?
	require("config.php");
	
	$db->query("SELECT * FROM messages","messages");
	$db->query("SELECT * FROM page WHERE id = 1","page");
	
	$query = $db->getQuery("page");
	$page = new Page();
	$page->createFromAssoc($query->getArray(MYSQL_ASSOC));
	
	$query = $db->getQuery("messages");
	$array = $query->getArray(MYSQL_ASSOC);
	
	$messages; $i;
	
	do {
		$messages[$i] = new Message();
		$messages[$i]->createMessageFromAssoc($array);
		$i++;
	} while ($array = $query->getArray(MYSQL_ASSOC));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
  	  	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  	  	<link href="style.css" type="text/css" rel="stylesheet" />
	  	<title><? echo $page->title; ?></title>
	</head>
	<body>
		<div id="wrapper">
			<div id="head">
				<? echo $page->title; ?>
			</div>
			
			<div id="body">
				<div id="text">
					<? echo $page->text; ?>
				</div>
				<div id="messageBody">
					<?
						if ($query->getNumRows() == 0) {
							print("<div id=\"nullMessage\">Нет ни одной записи.</div>");
						}
						else {
							foreach($messages as $key => $value) {
								printf("<div class=\"message\">
											<table class=\"messageTable\">
												<tr>
													<td class=\"double\">%s</td>
													<td class=\"double\">%s</td>
												</tr>
												<tr>
													<td colspan=\"2\">%s</td>
												</tr>
											</table>
										</div>"
									,$value->author,$value->date,$value->text);
							}
						}
					?>
				</div>
				<div id="form">
					<form action="sendMessage.php" method="POST">
						<table id="formTable">
							<tr>
								<td class="double"><label for="author">Имя: </label></td>
								<td class="double"><input type="text" id="author" name="author" value="" /></td>
							</tr>
							<tr>
								<td class="double"><label for="email">Е-Mail: </label></td>
								<td class="double"><input type="text" id="email" name="email" value="" /></td>
							</tr>
							<tr>
								<td class="double"><label for="text">Сообщение: </label></td>
								<td class="double"><textarea name="text" id="text"></textarea></td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="submit">
										<input type="submit" name="sub" value="Отправить!" />
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			
			<div id="footer">
				<? echo $page->footer; ?>
			</div>
		</div>
	</body>
</html>