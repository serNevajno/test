<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/function.inc.php');

  $id = clearData($_POST['id']);
  $id_provider = clearData($_POST['id_provider']);
  $id_order = clearData($_POST['id_order']);
  //$id_order = 4648;
  $send = '';

  $arr = array();

  function sProdOrderByIdOrder($id_order){
    return db2array("SELECT in_storage FROM order_product WHERE price > 0 AND id_order='$id_order'", 2);
  }


  foreach (sProdOrderByIdOrder($id_order) as $item){
    if($item['in_storage'] == 0){ $send = 1;}
  }


  if($send != 1){
    mysql_query("UPDATE `orders` SET `id_status` = '8' WHERE id='$id_order'");

    $order = selectOrderById($id_order);
    if($order['name']){$name = $order['name'];}else{$name = 'Покупатель';}
    $status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='8'");

    $to  = '<'.$order[email_order].'>'; // Кому
    $subject = '=?utf-8?B?'.base64_encode('Изминение статуса. Заказ №'.$id_order).'?='; // теме письма

    $text_sms = str_replace("#name#", $name, $status_text["sms_text"]);
    $text_sms = str_replace("#nomer#", $id_order, $text_sms);
    $text_sms = str_replace("#sum#", sumOrderReal($id_order), $text_sms);


    sendSMS($order["phone"], $text_sms, $id_order);


    $text = str_replace("#name#", $name, $status_text["email_text"]);
    $text = str_replace("#nomer#", $id_order, $text);
    $text = str_replace("#sum#", sumOrderReal($id_order), $text);
    $mess .= $text; // Само сообщение
    $headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
    $headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?='.$to.'';
    // Отправляем
    mail($to, $subject, $mess, $headers);
  }

  if(mysql_query("UPDATE order_product SET in_storage='$id_provider' WHERE id='$id'")){
    $arr['prov'] = 'yes';
  }

  echo json_encode($arr);
}