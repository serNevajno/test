<?
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	
	$name = clearData($_POST['name']);
	$email = clearData($_POST['email']);
	$pass = clearData($_POST['password']);
	$rpass = clearData($_POST['comfirm_pass']);
	$arr = array();
	
	if(checkEmail($email) > 0) {
		$arr['error_email'] = "Такой E-mail уже существует!";
	}elseif(mb_strlen($pass) < 6){
		$arr['error_pass'] = "Ваш пароль меньше 6-ти симвоолов!";
	}elseif(!$rpass){
		$arr['error_rpass'] = "Введите подтверждающий пароль";
	}elseif($pass != $rpass){
		$arr['error_pass'] = "Пароли не совпадают!";
		$arr['error_rpass'] = "Пароли не совпадают!";
	}else{

		// Заносим в базу
		$pass = md5($pass);
		$date = date("Y-m-d H:i:s");
		mysql_query("INSERT INTO users (name, email, password, `date`, active) VALUES ('$name', '$email', '$pass', '$date', '1')") or die(mysql_error());
		
		$last_id = mysql_insert_id();
		/*$url_site = "http://".$_SERVER['SERVER_NAME']."/";
		$activation = md5($last_id).md5($name).md5(0);
		
		$subject = '=?utf-8?B?'.base64_encode('Подтверждение регистрации').'?=';
		$message = "Здравствуйте <b style='color:#cb1010;'>".$name."</b>! <br>Спасибо за регистрацию на <a href='".$url_site."' style='color:#3b5998' target='_blanck'>".$_SERVER['SERVER_NAME']."</a><br><br>\nВаш логин для входа: <b style='color:#cb1010;'>".$email."</b><br><br>\n Перейдите по ссылке, чтобы активировать ваш аккаунт: <a href='".$url_site."index.php?email=".$email."&key=".$activation."' target='_blanck'>Активация акаунта</a>\n<br><br><b>С уважением,\n Администрация <a href='".$url_site."' style='color:#3b5998' target='_blanck'>".$_SERVER['SERVER_NAME']."</a></b>";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= 'From: =?UTF-8?B?' . base64_encode('Интернет-магазин '.$_SERVER['SERVER_NAME']) . '?= <info@'.$_SERVER['SERVER_NAME'].'>\r\n';
		mail($email, $subject, $message, $headers);*/
		
		$rMail = explode('@', $email);
		$arr['regOk'] = '<blockquote> <p>Ув.'.$name.' спасибо за регистрацию!</blockquote>';

	}
echo json_encode($arr);	
}?>