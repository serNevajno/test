<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
// Фильтруем полученные данные

$temp = db2array("SELECT t1.article, t1.id FROM product as t1 WHERE (SELECT COUNT(*) FROM product WHERE article=t1.article)>1 ORDER BY t1.id DESC", 2);

foreach ($temp as $items) {
    //$pr = db2array("SELECT id FROM product WHERE article='$items[article]' AND price='0'");
    ///mysql_query("DELETE FROM `product` WHERE id='$pr[id]'");
    //echo "DELETE FROM `product` WHERE id='$pr[id]'";
    echo $items[article];
    echo "<br>";
}
echo "ok2";
?>