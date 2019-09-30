<?
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

$arr = file_get_contents("http://online.shininvest.ru/Online8/robot.php?type=tires&login=13828&pwd=8AC99AB4209F82128BE665A2623D22ED");
$res = json_decode($arr, true);
mysql_query("TRUNCATE TABLE `bufer_shs` ");
foreach ($res as $item){
    mysql_query("INSERT INTO `bufer_shs`(`code`, `quantity`, `price`, `type`) VALUES ('$item[producer_code]', '$item[quantity]', '$item[price]', '1')");
}

echo count($res);
?>