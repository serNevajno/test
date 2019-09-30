<?php
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
/////Подключение библиотеки
include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

function sQuantityProd($product_id, $id_provider ){
  $temp = db2array("SELECT availability FROM `price_provider` WHERE id_product='$product_id' AND id_provider='$id_provider'");
  return $temp['availability'];
}

$id = clearData($_POST['id'], "i");
$price = clearData($_POST['price'], "i");
$price_clear = clearData($_POST['price_clear'], "i");
$logistic = clearData($_POST['logistic'], "i");
$id_provider = clearData($_POST['id_provider'], "i");
$product_id = clearData($_POST['product_id'], "i");
$quantity = clearData($_POST['quantity'], "i");
$region = clearData($_POST['region'], "i");
$chPr = clearData($_POST['chPr'], "i");


//echo "UPDATE `order_product` SET `price`='$price', `price_clear`='$price_clear', `day`='$logistic', `provider`='$id_provider' WHERE `id`='$id'";
if($chPr == 1) {
    mysql_query("UPDATE `order_product` SET `price`='$price', `price_clear`='$price_clear', `day`='$logistic', `provider`='$id_provider' WHERE `id`='$id'") or die(mysql_error());
}else{
    mysql_query("UPDATE `order_product` SET `price_clear`='$price_clear', `day`='$logistic', `provider`='$id_provider' WHERE `id`='$id'") or die(mysql_error());
}
if($id_provider == 7 OR $id_provider == 8 OR $id_provider == 11){
  $ctn = (int)sQuantityProd($product_id, $id_provider ) - (int)$quantity;
  //echo "UPDATE `price_provider` SET  availability='$ctn' WHERE id_product='$product_id' AND id_provider='$id_provider'";
  mysql_query("UPDATE `price_provider` SET  availability='$ctn' WHERE id_product='$product_id' AND id_provider='$id_provider'") or die(mysql_error());
  mysql_query("UPDATE `order_product` SET `in_storage`='$region' WHERE `id`='$id'") or die(mysql_error());
}else{
  switch ($region){
    case 1: $id_provider = 7; break;
    case 2: $id_provider = 8; break;
    case 3: $id_provider = 11; break;
  }

  $ctn = (int)sQuantityProd($product_id, $id_provider ) + (int)$quantity;
  //echo "UPDATE `price_provider` SET  availability='$ctn' WHERE id_product='$product_id' AND id_provider='$id_provider'";
  mysql_query("UPDATE `price_provider` SET  availability='$ctn' WHERE id_product='$product_id' AND id_provider='$id_provider'") or die(mysql_error());
}

$arr = array();

$arr['provider'] = $id_provider;
$arr['ctn'] = $ctn;

echo json_encode($arr);