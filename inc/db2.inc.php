<?php
ini_set('date.timezone', 'Asia/Yekaterinburg');
define("DB_HOST", "beautywo.mysql.tools");
define("DB_LOGIN", "beautywo_proj458");
define("DB_PASSWORD", "zg6gcvk5");
define("DB_NAME", "beautywo_proj458");

$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
mysql_query('SET NAMES utf8');
mysql_select_db(DB_NAME) or die(mysql_error());
?>