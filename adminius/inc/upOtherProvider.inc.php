<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
/////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  $id = clearData($_POST['id'], "i");
  $price_clear = clearData($_POST['price_clear'], "i");
  $price = clearData($_POST['price'], "i");
  $logistic = clearData($_POST['logistic'], "i");
  $arr = array();

  if(mysql_query("UPDATE `order_product` SET `price_clear`='$price_clear', `price`='$price', `day`='$logistic' WHERE `id`='$id'")){
    $arr['res'] = 'Поставщик изменен!';
  }else{
    $arr['res'] = 'Ошибка!';
  }
  echo json_encode($arr);
}
