<?
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//////Подключение к базе
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
		/////Подключение библиотеки
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
		
		$name = mysql_real_escape_string(htmlspecialchars(trim(strip_tags($_POST['name']))));
		$phone = mysql_real_escape_string(htmlspecialchars(trim(strip_tags($_POST['phone']))));
		$email = mysql_real_escape_string(htmlspecialchars(trim(strip_tags($_POST['email']))));
		$message = mysql_real_escape_string(htmlspecialchars(trim(strip_tags($_POST['message']))));
		
		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO order_services (`id_services`, `name`, `email`, `phone`, `message`, `date`) VALUES ('$id_services', '$name', '$email', '$phone', '$message', '$date')";
		//mysql_query($sql) or die(mysql_error());
		
		$to  = settingsSite()['email'].', ';; // Кому
		$to  .= '<s-gr@bk.ru>'; // Кому
		$subject = '=?utf-8?B?'.base64_encode('Заказ услуги '.$usluga).'?='; // теме письма
		$mess .= "<b>От кого:</b> ".$name."<br><br><b>Телефон:</b> ".$phone."<br><br><b>E-mail:</b> ".$email."<br><br><b>Сообщение:</b> ".$message; // Само сообщение
		$headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
		$headers .= 'From: =?UTF-8?B?' . base64_encode('Eko-Sistema') . '?= <'.$to.'>';
		// Отправляем
		//mail($to, $subject, $mess, $headers);
	
		echo "send";
	}
?>