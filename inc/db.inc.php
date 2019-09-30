<?php
	ini_set('date.timezone', 'Asia/Yekaterinburg');
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "dobraya");
	define("DB_PASSWORD", "Y2p0F3x2");
	define("DB_NAME", "dobraya");

	$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
	mysql_query('SET NAMES utf8');
	mysql_select_db(DB_NAME) or die(mysql_error());
?>