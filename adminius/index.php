<?error_reporting(0);
////запуск сессии
	if (!empty($_COOKIE['sid'])) {
		session_id($_COOKIE['sid']);
	}
	session_start();
	header("Content-Type: text/html; charset=UTF-8");
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');
	/////Замок
	include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');
	mysql_query("DELETE FROM `price_provider` WHERE `availability`='0'");
	$access = access();
	if($_GET["code"] == "orders" AND !$_GET["action"] AND !$_GET["id"]){
		setcookie("back_url", $_SERVER["REQUEST_URI"]);
	}		
	//echo "<pre>".print_r($_POST, true)."</pre>";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/inc.php');
	}
  if($_GET["print"]=="print"){
    include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/print.tpl.php');
  }elseif($_GET["print"]=="printA4"){
    include($_SERVER['DOCUMENT_ROOT'].'/adminius/templates/printA4.tpl.php');
  }else {
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/header.tpl.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/pageContainer.tpl.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/adminius/templates/footer.tpl.php');
  }
?>