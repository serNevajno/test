<?
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//////Подключение к базе
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
		/////Подключение библиотеки
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

		$name = clearData($_POST['name']);
		$phone = clearData($_POST['phone']);
		$message = clearData($_POST['message']);
		$email = clearData($_POST['email']);
		$vin = clearData($_POST['vin']);
		$model = clearData($_POST['listModel2']);
		$marka = clearData($_POST['listMarka2']);
		$year = clearData($_POST['listYear2']);
		$modifay = clearData($_POST['listModification2']);
		
		
		
		//echo "<pre>".print_r($_POST, true)."</pre>";
		
		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO messages (`vin`, `email`, `name`, `phone`, `message`, `date`, `model`, `marka`, `year`, `modifay`) VALUES ('$vin', '$email', '$name', '$phone', '$message', '$date', '$model', '$marka', '$year', '$modifay')";
		mysql_query($sql) or die(mysql_error());
		
		
		$to  = '<'.settingsSite()['emailTwo'].'>, '; // Кому
		$subject = '=?utf-8?B?'.base64_encode('Заказ детали').'?='; // теме письма
		$mess .= "<b>От кого:</b> ".$name."<br><br>
							<b>Телефон:</b> ".$phone."<br><br>
							<b>Email:</b> ".$email."<br><br>
							<b>VIN:</b> ".$vin."<br><br>
							<b>Авто:</b> ".$model." | ".$marka." | ".$year." | ".$modifay."<br><br>
							<b>Сообщение:</b> ".$message; // Само сообщение
		$headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
		$headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?= <'.$to.'>';
		// Отправляем
		mail($to, $subject, $mess, $headers);
	
		echo "send";
	}
?>