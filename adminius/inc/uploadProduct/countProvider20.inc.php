<?
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

/////Замок
include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/lock.inc.php');

file_put_contents($_SERVER['DOCUMENT_ROOT'].'/price_provider/prov20.xml', file_get_contents("http://cabinet.tochka-market.ru/catalog.xml"));
$arr = simplexml_load_file($_SERVER['DOCUMENT_ROOT']."/price_provider/prov20.xml");

echo count($arr->product);;
?>