<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['del_message'])){
		$sql = "DELETE FROM `messages` WHERE `id` IN ( " . implode( ', ', $_POST['del_message'] ) . " )";
		$result = mysql_query($sql) or die(mysql_error());
		header("Location: /adminius/index.php?code=message_admin");
		exit;
	}elseif(isset($_POST['message']) AND !isset($_POST['email'])){
		$message = clearData($_POST['message']);
		$id = clearData($_POST['id'], "i");
		$date = date("Y-m-d H:i:s");
		mysql_query("INSERT INTO `messages`(`message`, `id_user_from`, `id_user_to`, `date`) VALUES ('$message', '1', '$id', '$date')") or die('Что то не то');
		header("Location: /adminius/index.php?code=message_admin&action=detail&id=$id");
		exit;
	}elseif(isset($_POST['message']) AND isset($_POST['email'])){
			$date = date("Y-m-d H:i:s");
			$message = clearData($_POST['message']);
			mysql_query("INSERT INTO `message`(`message`, `date`, `email`, `admin`) VALUES ('$message', '$date', '$_POST[email]', '1')") or die('Что то не то');
			$url_site = "http://".$_SERVER["HTTP_HOST"];
			$subject = '=?utf-8?B?'.base64_encode('Ответ на сообщение stroiteli.net.ua').'?=';
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= 'From: =?UTF-8?B?' . base64_encode('STROITELI.NET.UA') . '?= <admin@stroiteli.net.ua>\r\n';
			mail($_POST['email'], $subject, $message, $headers);  
			header("Location: /adminius/index.php?code=message_admin&action=detail&email=".$_POST['email']);
			exit;
	}		
}?>