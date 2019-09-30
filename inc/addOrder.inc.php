<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	session_start(); 
	//////Подключение к базе
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
	/////Подключение библиотеки
	include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/gift/function.php');
	
	$fio = clearData($_POST["fio"]);
	$phone = clearData($_POST["phone"]);
	$address = clearData($_POST["address"]);
	$delivery = clearData($_POST["delivery"]);
	$comment = clearData($_POST["comment"]);
    $region = clearData($_POST["region"]);
	$id_user = selectIdUser();
	$date = date("Y-m-d H:i:s");
	
	$sBasket = selectBasket();
	if($sBasket){
		mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', '$region')") or die(mysql_error());
		$last_id = mysql_insert_id();

		foreach($sBasket as $iBasket){
			$name = mysql_real_escape_string($iBasket["name"]);

            if($iBasket[provider] == "7" OR $iBasket[provider] == "8" OR $iBasket[provider] == "11"){
                $in_storage = $region;
                $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='$iBasket[provider]' AND id_product='$iBasket[product_id]' ORDER BY date DESC LIMIT 1");
                $availability = $ava[availability] - $iBasket[quantity];
                mysql_query("UPDATE product SET availability='$availability' WHERE provider='$iBasket[provider]' AND id='$iBasket[product_id]'");
                mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='$iBasket[provider]' AND id_product='$iBasket[product_id]'");

            }else{
                $in_storage = '0';
            }

			mysql_query("INSERT INTO order_product (product_id, code, id_order, name, quantity, price, categories, day, sale, price_clear, provider, in_storage) VALUES ('$iBasket[product_id]', '$iBasket[code]', '$last_id', '$name', '$iBasket[quantity]', '$iBasket[price]', '$iBasket[categories]', '$iBasket[day]', '$iBasket[sale]', '$iBasket[price_clear]', '$iBasket[provider]', '$in_storage')") or die(mysql_error());
		}

        $resGift = selectGift();
        foreach($resGift as $iGift){
            $iProd = db2array("SELECT id, name, price, img, code, categories, price_clear, provider FROM product WHERE id='$iGift[id]'");
            mysql_query("INSERT INTO order_product (product_id, id_order, name, quantity, price, categories, day, sale, price_clear, provider, in_storage) VALUES ('$iGift[id]', '$last_id', '$iProd[name]', '$iGift[quantity]', '0', '$iProd[categories]', '0', '0', '$iProd[price_clear]', '$iProd[provider]', '$region')") or die(mysql_error());
        }


		mysql_query("DELETE FROM basket WHERE customer='".session_id()."'") or die(mysql_error());
		$status_text = db2array("SELECT sms_text, email_text FROM status WHERE id='5'");

        $to  = '<'.selectUserById($id_user)['email'].'>'; // Кому
        $subject = '=?utf-8?B?'.base64_encode('Изминение статуса. Заказ №'.$last_id).'?='; // теме письма

        $text_sms = str_replace("#name#", $name, $status_text["sms_text"]);
        $text_sms = str_replace("#nomer#", $last_id, $text_sms);
        $text_sms = str_replace("#sum#", sumOrderReal($last_id), $text_sms);

        sendSMS($phone, $text_sms, $last_id);

        $text = str_replace("#name#", $name, $status_text["email_text"]);
        $text = str_replace("#nomer#", $last_id, $text);
        $text = str_replace("#sum#", sumOrderReal($last_id), $text);
        $mess .= $text; // Само сообщение
        $headers  = 'MIME-Version: 1.0' . "\r\n"; // Что бы отправлять HTML, устанавливаем Content-type заголовки
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";  // тут установить ту кодировку с которой вы работатете
        $headers .= 'From: =?UTF-8?B?' . base64_encode('dobrayashina.ru') . '?='.$to.'';
        // Отправляем
        if($id_user){
             mail($to, $subject, $mess, $headers);
        }
	}
	echo $last_id;
}?>