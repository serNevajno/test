<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//////Подключение к базе
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
		/////Подключение библиотеки
		include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
		
		foreach ($_POST as $secvalue) {
			if ((preg_match("/<[^>]*script *\"?[^>]*>/i", $secvalue)) ||
			(preg_match("/<[^>]*style*\"?[^>]*>/i", $secvalue))) {
				die("BAD YOUR CODE");
				exit;
			}
		}
		session_start();
		
    $email = clearData($_POST['email']);
    $pass = clearData($_POST['password']);
		$arr = array();
		
    if($email!="" && $pass!="") {
			$item = selectUser($email);
			//id, password, name, active//
			
				//$arr['arr'] = $item["name"]."-".$item["active"]."-".$item["id"];
					if(md5($pass) == $item["password"] && (!empty($item))) {
						if($item['active'] == 1){
							$sid = session_id();
							
							$date = date("Y-m-d H:i:s");
							mysql_query("INSERT INTO user_session (id_user, sid, date) VALUES ('$item[id]', '$sid', '$date')");
							
							$ip = $_SERVER['REMOTE_ADDR'];
							mysql_query("INSERT INTO user_logs (id_user, ip, date, actions) VALUES ('$item[id]', '$ip', '$date', '1')");

							$arr['ok'] = "ok";
						}else{
							$arr['error_active'] = 'Ув. '.$item["name"].' ваш аккаунт не активирован!';
						}
					}else{
						$ip = $_SERVER['REMOTE_ADDR'];
                        $date = date("Y-m-d H:i:s");
						mysql_query("INSERT INTO user_logs (id_user, ip, date, actions) VALUES ('$item[id]', '$ip', '$date', '2')");
						$arr['error_login'] = 'Вы ввели не верный логин или пароль!';
					}
				

		}
		echo json_encode($arr);
	}
?>	