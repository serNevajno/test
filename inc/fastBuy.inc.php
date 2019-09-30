<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    //////Подключение к базе
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
    /////Подключение библиотеки
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');
    include ($_SERVER['DOCUMENT_ROOT'].'/inc/gift/function.php');
    //include ($_SERVER['DOCUMENT_ROOT'].'/inc/apiFunc.inc.php');

    $quantity = clearData($_POST["quantity"], "i");
    $code = clearData($_POST["code"]);
    $type = clearData($_POST["type"]);
    $fio = clearData($_POST["fio"]);
    $phone = clearData($_POST["phone"]);
    $address = clearData($_POST["address"]);
    $delivery = clearData($_POST["delivery"]);
    $comment = clearData($_POST["comment"]);
    $region = clearData($_POST["region"]);
    $id_user = selectIdUser();

    if($quantity>0){

        $date = date("Y-m-d H:i:s");

        if($type == "tyres"){
            /*$iProduct = fullProductTyresApi($code);
            if($iProduct){
                $name = mysql_real_escape_string($iProduct["name"]);
                mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', '$region')") or die(mysql_error());
                $last_id = mysql_insert_id();

                mysql_query("INSERT INTO order_product (product_id, code, id_order, name, quantity, price, categories, day, price_clear) VALUES ('0', '$iProduct[code]', '$last_id', '$name', '$quantity', '$iProduct[price]', '$type', '$iProduct[dayLog]', '$iProduct[price_clear]')") or die(mysql_error());
            }*/
        }elseif($type == "disk"){
            /*$iProduct = fullProductDiskApi($code);

            if($iProduct){
                $name = mysql_real_escape_string($iProduct["name"]);
                mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', '$region')") or die(mysql_error());
                $last_id = mysql_insert_id();

                mysql_query("INSERT INTO order_product (product_id, code, id_order, name, quantity, price, categories, day, price_clear) VALUES ('0', '$iProduct[code]', '$last_id', '$name', '$quantity', '$iProduct[price]', '$type', '$iProduct[dayLog]', '$iProduct[price_clear]')") or die(mysql_error());
            }*/
        }else{
            $iProduct = selectProductById($code);
            if($iProduct){
                $name = mysql_real_escape_string($iProduct["name"]);
                mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', '$region')") or die(mysql_error());
                $last_id = mysql_insert_id();

                if($iProduct["provider"] == "7"){
                    $in_storage = "1";
                    $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='7' AND id_product='$iProduct[id]' ORDER BY date DESC LIMIT 1");
                    $availability = $ava[availability] - $quantity;
                    mysql_query("UPDATE product SET availability='$availability' WHERE provider='7' AND id='$iProduct[id]'");
                    mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='7' AND id_product='$iProduct[id]'");

                }else{
                    $in_storage = '0';
                }

                $price = $iProduct["price"] - (($iProduct["price"] / 100)*$iProduct["sale"]);
                mysql_query("INSERT INTO order_product (product_id, code, id_order, name, quantity, price, price_clear, categories, day, sale, provider, in_storage) VALUES ('$code', '', '$last_id', '$name', '$quantity', '$price', '$iProduct[price_clear]', '$iProduct[categories]', '$iProduct[logistic]', '$iProduct[sale]' , '$iProduct[provider]', '$in_storage')") or die(mysql_error());

                $gift = selectGiftFastBuy($code, $iProduct[categories], $quantity, $iProduct["price"]);
                foreach($gift as $iGift){
                    $iProd = db2array("SELECT id, name, price, img, code, categories, price_clear, provider FROM product WHERE id='$iGift[id]'");
                    mysql_query("INSERT INTO order_product (product_id, id_order, name, quantity, price, categories, day, sale, price_clear, provider, in_storage) VALUES ('$iGift[id]', '$last_id', '$iProd[name]', '$iGift[quantity]', '0', '$iProd[categories]', '0', '0', '$iProd[price_clear]', '$iProd[provider]', '0')") or die(mysql_error());
                }

            }
        }

        echo $last_id;
    }
}
?>