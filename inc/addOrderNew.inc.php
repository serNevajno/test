<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    //////Подключение к базе
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/gift/function.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/

    $region = "1";
    $type = clearData($_POST["type"], "i");
    if($type == "1"){
        $region = clearData($_POST["office"]);
    }elseif($type == "2"){
        $addressDev = clearData($_POST["addressDevFull"]);
    }elseif($type == "3"){
        $divTransCom = clearData($_POST["divTransCom"]);
        if($divTransCom == "1"){
            $nDivTC = "ДТ";
        }elseif ($divTransCom == "2"){
            $nDivTC = "ДД";
        }
        $trans_company = clearData($_POST["sTransCom"]);
        $addressDev = $nDivTC.". ".clearData($_POST["region"]).", ".clearData($_POST["city"]);
        if(clearData($_POST["region"]) == "Респ. Башкортостан"){
            $region = "2";
        }elseif (clearData($_POST["region"]) == "обл. Свердловская"){
            $region = "3";
        }
        if($divTransCom == "2") {
            $addressDev.= clearData($_POST["addressDev"])." ".clearData($_POST["dom"]).", кв(офис) ".clearData($_POST["kv"]);
        }
    }

    $typeUser = clearData($_POST["typeUser"], "i");
    if($typeUser == "1"){
        $name = clearData($_POST["famFIZ"])." ".clearData($_POST["nameFIZ"])." ". clearData($_POST["midNameFIZ"]);
        $phone = clearData($_POST["resFiz"]); ////
        $email = clearData($_POST["emailFiz"]);
        $commPhone= clearData($_POST["commPhoneFiz"]);
        $comments = clearData($_POST["commentsFiz"]);
        $info = clearData($_POST["infoFiz"]);
    }elseif ($typeUser == "2"){
        $name = clearData($_POST["nameIP"]);
        $email = clearData($_POST["emailIP"]);
        $inn = clearData($_POST["inn"]);
        $address = clearData($_POST["addressIP"]);
        $nameContact = clearData($_POST["nameContact"]);
        $phone = clearData($_POST["resIP"]); ////
        $commPhone = clearData($_POST["commPhoneIP"]);
        $comments = clearData($_POST["commentsIP"]);
        $info = clearData($_POST["infoIP"]);
    }elseif ($typeUser == "3"){
        $name = clearData($_POST["nameUR"]);
        $inn = clearData($_POST["innUR"]);
        $kpp = clearData($_POST["kpp"]);
        $address = clearData($_POST["addressUR"]);
        $nameContact = clearData($_POST["nameContactUR"]);
        $phone = clearData($_POST["resUR"]);
        $email = clearData($_POST["emailUR"]);
        $commPhone = clearData($_POST["commPhoneYR"]);
        $comments = clearData($_POST["commentsUR"]);
        $info = clearData($_POST["infoUR"]);
    }

    $pay = clearData($_POST["pay"]);

    $id_user = selectIdUser();
    $date = date("Y-m-d H:i:s");

    $sBasket = selectBasket();
    if($sBasket){
        $arPhone = explode(", ", $phone);
        mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, name_сontact, INN, KPP, jur_address, email, typeUser, commPhone, info, pay, region, trans_company) VALUES ('$name', '$arPhone[0]', '$type', '$addressDev', '$comments', '$id_user', '$date', '5', '$nameContact', '$inn', '$kpp', '$address', '$email', '$typeUser', '$commPhone', '$info', '$pay', '$region', '$trans_company')") or die(mysql_error());
       $last_id = mysql_insert_id();
       $ip = 1;
       foreach($arPhone as $iPhone){
          if($ip>1){
              mysql_query("INSERT INTO `phones`(`id_order`, `phone`) VALUES ('$last_id', '$iPhone')") or die(mysql_error());
          }
       $ip++;}

        foreach($sBasket as $iBasket){
            $name = mysql_real_escape_string($iBasket["name"]);

            if($iBasket[provider] == "7" OR $iBasket[provider] == "8" OR $iBasket[provider] == "11"){
                $in_storage = $region;
                $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='$iBasket[provider]' AND id_product='$iBasket[product_id]' ORDER BY date DESC LIMIT 1");
                $availability = $ava[availability] - $iBasket[quantity];

                if($availability>0) {
                    mysql_query("UPDATE product SET availability='$availability' WHERE provider='$iBasket[provider]' AND id='$iBasket[product_id]'");
                    mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='$iBasket[provider]' AND id_product='$iBasket[product_id]'");
                }else{
                    mysql_query("UPDATE product SET availability='0' WHERE provider='$iBasket[provider]' AND id='$iBasket[product_id]'");
                    $googPrice = selectGoodPrice($iBasket[product_id]);
                    mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$iBasket[product_id]'");
                }
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