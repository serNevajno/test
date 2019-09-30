<?php
session_start();
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

/*$result = db2array("SELECT id, img FROM product", 2);
foreach ($result as $item){
  $healthy = array(".jpg.jpg");
  $yummy = array(".jpg");
  $newphrase = str_replace($healthy, $yummy, $item['img']);

  if($item['img'] != $newphrase){
    //echo $item['code']." = ".$newphrase."<br>";
    //mysql_query("UPDATE `product` SET `img`='$newphrase' WHERE id='$item[id]'");
  }
}*/
?>