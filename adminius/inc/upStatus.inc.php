<?php
	if (isset($_POST['id'])) {
		// Фильтруем полученные данные
		$id = clearData($_POST['id']);
		$status = clearData($_POST['status']);
		$expectation = clearData($_POST['expectation']);
    $date = date("Y-m-d H:i:s");
    $sms = clearData($_POST['sms']);
		
    $temp = db2array("SELECT id_status, id_admin, phone FROM `orders` WHERE id='$id'");
    if($temp["id_status"] == '5' AND $temp["id_admin"] == '0'){
			$id_admin = selectWhatUser();
			mysql_query("UPDATE `orders` SET `id_admin`='$id_admin' WHERE id='$id'");
		}
		
    if($status == '1'){
			mysql_query("UPDATE `orders` SET `date_end`='$date' WHERE id='$id'");
	}
    if($status == '3'){
            $temp_region = db2array("SELECT region FROM `orders` WHERE id='$id'");
            if($temp_region["region"] == "1"){
                $provider = "7";
            }elseif($temp_region["region"] == "2"){
                $provider = "8";
            }elseif($temp_region["region"] == "3"){
                $provider = "11";
            }
            $temp_product = db2array("SELECT quantity, product_id, price, price_clear, provider FROM `order_product` WHERE id_order='$id' AND (provider='7' OR provider='8' OR provider='11' OR in_storage>'0')", 2);

            foreach($temp_product as $item){
                $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='$provider' AND id_product='$item[product_id]' ORDER BY date DESC LIMIT 1");
                if($ava) {
                    $availability = $item["quantity"] + $ava["availability"];

                    mysql_query("UPDATE product SET availability='$availability' WHERE provider='$provider' AND id='$item[product_id]'");
                    mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='$provider' AND id_product='$item[product_id]'");
                }else{
                    $date = date("Y-m-d H:i:s");
                    $availability = $item["quantity"];
                    mysql_query("INSERT INTO `price_provider`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`, `availability`, `date`) VALUES ('$item[product_id]', '$item[price]', '$item[price_clear]', '0', '$provider', '$availability', '$date')");
                }
            }
    }
    if($status == '11'){
            mysql_query("UPDATE `orders` SET `date_expectation`='$date', `expectation_hours` ='$expectation' WHERE id='$id'");
    }
    mysql_query("UPDATE `orders` SET `id_status`='$status' WHERE id='$id'");
		
    if(selectUserById(selectOrderById($id)['id_user'])['name']){$name = selectUserById(selectOrderById($id)['id_user'])['name'];}else{$name = 'Покупатель';}
		$status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='$status'");
		  $to  = '<'.selectUserById(selectOrderById($id)['id_user'])['email'].'>'; // Кому
		  $subject = '=?utf-8?B?'.base64_encode('Изминение статуса. Заказ №'.$id).'?='; // теме письма

		  $text_sms = str_replace("#name#", $name, $status_text["sms_text"]);
		  $text_sms = str_replace("#nomer#", $id, $text_sms);
		  $text_sms = str_replace("#sum#", sumOrderReal($id), $text_sms);

		  if($sms == '1') {
            sendSMS($temp["phone"], $text_sms, $id);
         }

		  $text = str_replace("#name#", $name, $status_text["email_text"]);
		  $text = str_replace("#nomer#", $id, $text);
		  $text = str_replace("#sum#", sumOrderReal($id), $text);
		  $mess .= $text; // Само сообщение
		  $headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
		  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
		  $headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?='.$to.'';
		  // Отправляем
		  mail($to, $subject, $mess, $headers);
		
		
		header('Location: /adminius/index.php?code=orders&action=edit&id='.$id);
		exit;
	}
?> 