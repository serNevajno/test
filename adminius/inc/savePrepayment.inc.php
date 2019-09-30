<?php
if (isset($_POST['id'])) {
  $id = clearData($_POST['id']);
  $prepayment = clearData($_POST['prepayment'], "i");
  $date = date('Y-m-d H:i:s');
  $card = clearData($_POST['card'], "i");
  $sms = clearData($_POST['sms']);
  //$status = clearData($_POST['status']);

  $temp = db2array("SELECT id_status, id_admin, phone FROM `orders` WHERE id='$id'");

  if($temp["id_status"] == '5' AND $temp["id_admin"] == '0'){
    $id_admin = selectWhatUser();
    mysql_query("UPDATE `orders` SET `id_admin`='$id_admin' WHERE id='$id'");
  }

  if($card != '1'){
      $card = '0';
  }
  if($temp["id_status"] == '11'){

  }
  if($temp["id_status"] != '1') {
      mysql_query("UPDATE `orders` SET `prepayment`='$prepayment', `prepayment_date`='$date', `in_card`='$card', `id_status` = '2' WHERE id='$id'");
      if($temp["id_status"] == '11'){
        mysql_query("UPDATE `orders` SET `id_status` = '16' WHERE id='$id'");
      }
      if($card == '1'){
          mysql_query("INSERT INTO `prepayment`(`order_id`, `summ`, `date`, `status`) VALUES ('$id','$prepayment','$date','0')");
      }
      $order = selectOrderById($id);
      if ($order['name']) {
          $name = $order['name'];
      } else {
          $name = 'Покупатель';
      }
      $status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='2'");

      $to = '<' . $order[email_order] . '>'; // Кому
      $subject = '=?utf-8?B?' . base64_encode('Изминение статуса. Заказ №' . $id) . '?='; // теме письма

      $text_sms = str_replace("#name#", $name, $status_text["sms_text"]);
      $text_sms = str_replace("#nomer#", $id, $text_sms);
      $text_sms = str_replace("#sum#", sumOrderReal($id), $text_sms);

      if ($sms == '1') {
          sendSMS($temp["phone"], $text_sms, $id);
      }

      $text = str_replace("#name#", $name, $status_text["email_text"]);
      $text = str_replace("#nomer#", $id, $text);
      $text = str_replace("#sum#", sumOrderReal($id), $text);
      $mess .= $text; // Само сообщение
      $headers = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
      $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
      $headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?=' . $to . '';
      // Отправляем
      mail($to, $subject, $mess, $headers);
  }
  header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
  exit;
}
?>