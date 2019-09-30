<?php
ini_set('date.timezone', 'Asia/Yekaterinburg');
define("DB_HOST", "dobrayash.mysql");
define("DB_LOGIN", "dobrayash_new");
define("DB_PASSWORD", "4EFqcm:Q");
define("DB_NAME", "dobrayash_new");

$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
mysql_query('SET NAMES utf8');
mysql_select_db(DB_NAME) or die(mysql_error());

$date = date('Y-m-d H:i:s');

mysql_query("INSERT INTO `user_work_time`(id_user, `robot`) VALUES ('0', '1')") or die(mysql_error());
?>