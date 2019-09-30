<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	$text_message = $_POST["text_message"];
	$text_message_stroy = $_POST["text_message_stroy"];
	
	if(!empty($text_message)) {
		$text = "`text`='$text_message'";
	}
	if(!empty($text_message_stroy)) {
		$text = "`text_two`='$text_message_stroy'";
	}
	mysql_query("UPDATE `invitations_text` SET $text WHERE 1");
	
	header('Location: index.php?code=invitations');
	exit;
}?>