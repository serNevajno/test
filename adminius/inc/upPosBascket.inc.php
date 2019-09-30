<?php
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

$id = clearData($_POST['id'], "i");
$price = clearData($_POST['price'], "i");
$price_clear = clearData($_POST['price_clear'], "i");
$logistic = clearData($_POST['logistic'], "i");
$id_provider = clearData($_POST['id_provider'], "i");

echo "UPDATE `basket` SET `price`='$price', `price_clear`='$price_clear', `day`='$logistic' WHERE `id`='$id'";
mysql_query("UPDATE `basket` SET `price`='$price', `price_clear`='$price_clear', `day`='$logistic' WHERE `id`='$id'");
