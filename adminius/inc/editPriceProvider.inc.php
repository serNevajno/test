<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

  $id = clearData($_POST['id']);
  $price_clear = clearData($_POST['price_clear']);
  $cause = clearData($_POST['cause']);

  $arr = array();


  if (mysql_query("UPDATE order_product SET price_clear='$price_clear', change_price_clear='1' WHERE id='$id'")){
    $arr['res'] = 'yes';
  }

  echo json_encode($arr);
}