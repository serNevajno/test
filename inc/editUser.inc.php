<?if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
	// Фильтруем полученные данные
	
	$name = clearData($_POST['name']);
	$email = clearData($_POST['email']);
	$date_birth =  $_POST['date_birth'];
	$phone = clearData($_POST['phone']);
	$city = clearData($_POST['city']);
	$address = clearData($_POST['address']);
	$country = clearData($_POST['country'], "i");
	$sex = clearData($_POST['sex'], "i");
	$info = clearData($_POST['info'], "i");
	$pass = clearData($_POST['password']);
	$arr = array();
	
	$arr['date_birth'] = $date_birth;
	// Заносим в базу

	if ($pass != ""){
			if(mb_strlen($pass) < 6){
				$arr['error_pass'] = "Ваш пароль меньше 6-ти симвоолов!";
			}else{
				$pass = md5($pass);
				$insertPass = ", password='$pass' ";
			}
	}

	mysql_query("UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`sex`='$sex',`date_birth`='$date_birth',`address`=	'$address',`city`='$city',`id_country`='$country', info='$info'".$insertPass."WHERE id=(SELECT id_user FROM user_session WHERE sid='".session_id()."')");
			$arr['updateOk'] = 'true';
	
	echo json_encode($arr);	
}
?>