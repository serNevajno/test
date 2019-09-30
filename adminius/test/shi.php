<?
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

$arr = file_get_contents("http://online.shininvest.ru/Online8/robot.php?type=tires&login=13828&pwd=8AC99AB4209F82128BE665A2623D22ED");
$res = json_decode($arr, true);
echo "<pre>";
echo print_r($res, true);
echo "</pre>";
?>