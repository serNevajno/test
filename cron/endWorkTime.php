<?php
ini_set('date.timezone', 'Asia/Yekaterinburg');
define("DB_HOST", "localhost");
define("DB_LOGIN", "a0224336_shin");
define("DB_PASSWORD", "vwKPVpOv");
define("DB_NAME", "a0224336_shin");

$db = @mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die("Ошибка соединения с сервером баз данных");
mysql_query('SET NAMES utf8');
mysql_select_db(DB_NAME) or die(mysql_error());

$date = date('Y-m-d H:i:s');

mysql_query("UPDATE user_work_time SET date_end='$date', robot='1' WHERE date_end = '0000-00-00 00:00:00'") or die(mysql_error());
