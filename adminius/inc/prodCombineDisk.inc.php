<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

$arr = array();
$id_main = clearData($_POST['id_main'], "i");
$id_second = clearData($_POST['id_second'], "i");

$sProdSecond = selectProductById($id_second);


if(mysql_query("INSERT INTO `product_articles`(`id_product`, `article`, `provider`) VALUES ('$id_main','$sProdSecond[article]', '$sProdSecond[provider_upload]')")){
  if(mysql_query("UPDATE `product` SET `active`='0' WHERE id='$id_second'")){
    mysql_query("UPDATE `product` SET `provider_upload`='$sProdSecond[provider_upload]' WHERE id='$id_second' AND `provider_upload`='0'");
    if(mysql_query("UPDATE `price_provider` SET `id_product`='$id_main' WHERE id_product='$id_second'")){
      $arr['mess'] = 'OK';
    }else{
      $arr['mess'] = 'no update price provider';
    }
  }else{
    $arr['mess'] = 'no update product: active UPDATE `product` SET `active`=0 WHERE id='.$id_second;
  }
}else{
  $arr['mess'] = 'no insert product articles';
}

echo json_encode($arr);