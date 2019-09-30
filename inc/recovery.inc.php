<?php
if (isset($_POST['email'])) {
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	// Фильтруем полученные данные
	$email = clearData($_POST['email']);
	
	// Заносим в базу
	if (checkEmail($email) == 0) {
		echo "Такой E-mail в базе не найден.";
	}else{
		$temp = db2array("SELECT id, password FROM users WHERE email='$email'");
		if ($temp) {
			$url_site = "http://".$_SERVER["HTTP_HOST"];
			$activation = md5(md5($temp["id"]).md5($temp["password"]));
			
			$subject = '=?utf-8?B?'.base64_encode('Восстановление пароля').'?=';
      $message = "Вы, или кто-то другой, запросили новый пароль к аккаунту связаному с этим адресом (".$email.").\n\nЕсли это были не вы, проигнорируйте это письмо. Пожалуста не отвечайте.\n\nЕсли вы подтверждаете этот запрос, перейдите по следующей ссылке:\n\n".$url_site."/index.php?id=".$temp["id"]."&secret=".$activation."\n\nПосле того как вы это сделаете, ваш пароль будет сброшен и новый пароль будет отправлен вам на E-Mail.\n\n--\n";
			$headers .= "Content-type: text/plain; charset=utf-8\r\n";
			$headers .= 'From: =?UTF-8?B?' . base64_encode('Добрая шина') . '?= <info@dobrayashina.ru>\r\n';
      mail($email, $subject, $message, $headers);
			echo "1";
		}

	}
}elseif (isset($_GET["id"]) AND (isset($_GET["secret"]))) {
	$id = (int)$_GET["id"];
	$secret = $_GET["secret"];
	
	$temp = db2array("SELECT email, password FROM users WHERE id='$id'");
	
	
	$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

	// Количество символов в пароле.

	$max=10;

	// Определяем количество символов в $chars

	$size=StrLen($chars)-1;

	// Определяем пустую переменную, в которую и будем записывать символы.

	$password=null;

	// Создаём пароль.

    while($max--)
    $password.=$chars[rand(0,$size)]; 
		
	if ($secret == md5(md5($id).md5($temp["password"]))) {
		$sql_up = "UPDATE users SET password='".md5($password)."' WHERE id='$id'";
		$result_up = mysql_query($sql_up) or die(mysql_error());
		
		$url_site = "http://".$_SERVER["HTTP_HOST"];
		$activation = md5(md5($temp["id"]).md5($temp["password"]));
		$subject = '=?utf-8?B?'.base64_encode('Новый пароль').'?=';
    $message = "По вашему запросу на восстановление пароля, вы сгенерировали вам новый пароль.\n\nВот ваши новые данные для этого аккаунта:\n\n    Емеил: ".$temp["email"]."\n    Пароль:  ".$password."\n\n--\n";
		$headers .= "Content-type: text/plain; charset=utf-8\r\n";
		$headers .= 'From: =?UTF-8?B?' . base64_encode('Добрая шина') . '?= <info@dobrayashina.ru>\r\n';
    mail($temp["email"], $subject, $message, $headers);
			
		header("Location: /");
		exit;
	}else{
		header("Location: /");
		exit;
	}
}
?>