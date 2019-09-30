<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$id = clearData($_POST['id'], "i");
$id_provider = clearData($_POST['id_provider'], "i");

$arr = array();

function sProd($id, $id_provider){
  return db2array("SELECT t1.name, t1.id, t1.article, t2.price, t2.price_clear, t2.logistic, t2.id_provider, t2.availability, t3.name as name_provider FROM product as t1 
    LEFT JOIN price_provider as t2 on (t1.id = t2.id_product ) 
    LEFT JOIN provider as t3 on (t2.id_provider = t3.id ) 
  WHERE t1.id = '$id' AND t2.id_provider='$id_provider'");
}

foreach (sProd($id, $id_provider) as $key=>$val){
  $arr[$key] = $val;
}



echo json_encode($arr);