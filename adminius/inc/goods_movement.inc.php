<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $date_invoice = clearData($_POST['date_invoice']);
  $num_invoice = clearData($_POST['num_invoice']);
  $region = clearData($_POST['region']);

  function sOrderIdByIdProd($id){
    $temp = db2array("SELECT id_order FROM order_product WHERE id='$id'");
    return $temp['id_order'];
  }
  function checkSendSms($id_order){
        $send = 0;
        $temp = db2array("SELECT t1.in_storage, t2.region FROM order_product as t1 LEFT JOIN orders t2 on(t1.id_order=t2.id) WHERE t1.price > 0 AND t1.id_order='$id_order'", 2);
        foreach ($temp as $item){
            if($item['in_storage'] == 0 OR $item['in_storage'] != $item['region']){
                $send = 1;
            }
        }
        return $send;
  }
  mysql_query("INSERT INTO invoices (num_invoice, date_invoice) VALUES ('$num_invoice', '$date_invoice')") or die(mysql_error());
  $last_id = mysql_insert_id();

  foreach ($_POST['arr_id_order_prod'] as $k => $v){
    $id_order = sOrderIdByIdProd($v);
    $send = 0;
    mysql_query("INSERT INTO invoice_prod (id_invoice, id_order, id_order_prod) VALUES ('$last_id', '$id_order', '$v')") or die(mysql_error());
    mysql_query("UPDATE `order_product` SET `in_storage`='$region' WHERE id='$v'");
      
    if(checkSendSms($id_order) != 1){
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
  }

  //echo "<pre>" . print_r($_POST, true) . "</pre>";
  header('Location: index.php?code='.$_POST['func']);
  exit;
}
