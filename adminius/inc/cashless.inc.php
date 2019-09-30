<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id = clearData($_POST['id_order']);
   /* $date_obj = DateTime::createFromFormat('d F Y - H:i', $_POST['date']);
    $date = $date_obj->format('Y-m-d H:i:s');*/
    $date = clearData($_POST['date']);
    $nomer = clearData($_POST['nomer']);

    $item = selectOrderById($id);

    mysql_query("INSERT INTO `cashless`(`nomer`, `id_order`, `date`) VALUES ('$nomer', '$id', '$date')");
    mysql_query("UPDATE `orders` SET `id_status`='16' WHERE id='$id'");

    $status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='16'");
    $to  = '<'.selectUserById($item['id_user'])['email'].'>'; // Кому
    $subject = '=?utf-8?B?'.base64_encode('Изминение статуса. Заказ №'.$id).'?='; // теме письма

    $text_sms = str_replace("#name#", $item["name"], $status_text["sms_text"]);
    $text_sms = str_replace("#nomer#", $id, $text_sms);
    $text_sms = str_replace("#sum#", sumOrderReal($id), $text_sms);

    sendSMS($item["phone"], $text_sms, $id);

    $text = str_replace("#name#", $item["name"], $status_text["email_text"]);
    $text = str_replace("#nomer#", $id, $text);
    $text = str_replace("#sum#", sumOrderReal($id), $text);
    $mess .= $text; // Само сообщение
    $headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
    $headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?='.$to.'';
    // Отправляем
    mail($to, $subject, $mess, $headers);

    header('Location: index.php?code=cashless');
    exit;
}
?>