<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
//////Подключение к базе
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

$arr = array();
$arrCat = recusiveCatSection('1');
$query_search.="t1.categories IN (";
$n = 1;
$zp="";
$id="";

foreach ($arrCat as $iCat){
  if($n>1) $zp=", ";
  $query_search.= $zp.$iCat;
  $id.= $zp.$iCat;
  $n++;
}

$query_search.= ")";
$temp = db2array("SELECT t1.id, t1.name FROM product as t1 WHERE $query_search AND (SELECT COUNT(*) FROM `filter_value` WHERE `id_product`=t1.id)<5", 2);

foreach($temp as $item){
  echo "<a target='_blanck' href='https://dobrayashina.ru/adminius/index.php?code=product&action=edit&id=".$item[id]."'>".$item["name"]."</a><br>";
 /* $co = db2array("SELECT COUNT(*) FROM `filter_value` WHERE `id_filter`='21' AND `id_product`='$item[id]'");
  if($co['COUNT(*)'] == 0){
    $esss = explode("/", $item['name']);
    $ex = explode("R", $esss[1]);
    $es = explode(' ', $ex[0]);

    //echo $item['name']." - ".$ex[0]."<br>";
    $idFil = db2array("SELECT `id` FROM `element_filter` WHERE `value`='$ex[0]' AND `id_filter`='21'");

    if($idFil){
      //mysql_query("INSERT INTO `filter_value` (`id_filter`, `element_value`, `id_product`, `id_model`) VALUES ('21','$idFil[id]','$item[id]','0')");
    }
  }*/
}
echo "ok";