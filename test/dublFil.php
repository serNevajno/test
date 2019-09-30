<?
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

//$temp = db2array("SELECT id_product FROM `filter_value` as t1 WHERE (SELECT COUNT(*) FROM filter_value WHERE id_product=t1.id_product AND id_filter IN (19,20,21,23,24,25,26,27,28,29))>5 GROUP BY t1.`id_product`", 2);

/*foreach ($temp as $item){
  echo $item[id_product]."<br>";
  //mysql_query("DELETE FROM product WHERE id='$item[id_product]'") or die(mysql_error());
  //("DELETE FROM price_provider WHERE id_product='$item[id_product]'") or die(mysql_error());
  //mysql_query("DELETE FROM filter_value WHERE id_product='$item[id_product]'") or die(mysql_error());
}*/
echo "ok";
?>