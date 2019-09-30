<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

  $id_order_prod = clearData($_POST['id_order_prod'], 'i');
  $quantity = clearData($_POST['quantity'], 'i');
  $summPriceClear = clearData($_POST['summPriceClear'], 'i');

  $price_clear = $summPriceClear/$quantity;
  $arr = array();

  if($quantity > 0 AND $summPriceClear > 0){
    if(mysql_query("UPDATE order_product SET quantity='$quantity', price_clear='$price_clear' WHERE id='$id_order_prod'")){
      $arr['res'] = 'yes';
      $arr['price_clear'] = $price_clear;
    }
  }

  echo json_encode($arr);
}