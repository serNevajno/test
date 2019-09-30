<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

 //echo "<pre>".print_r($_POST['provider'])."</pre>";

  $fio = clearData($_POST["fio"]);
  $phone = clearData($_POST["phone"]);
  $address = clearData($_POST["address"]);
  $delivery = clearData($_POST["delivery"]);
  $id_user = selectIdUserAdminSession();
  $date = date("Y-m-d H:i:s");
  $prov = $_POST['provider'];
  $id_admin = selectWhatUser();
  $sBasket = selectBasket();
  $region_id = clearData($_POST['region'], "i");

  if($sBasket){

    mysql_query("INSERT INTO orders (name, phone, delivery, address, comment, id_user, date, id_status, order_phone, id_admin, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', 'T', '$id_admin', '$region_id')") or die(mysql_error());
    $last_id = mysql_insert_id();

    foreach($sBasket as $iBasket){
      $name = mysql_real_escape_string($iBasket["name"]);
      $id = $iBasket['id'];
      if($prov[$id] == "7" OR $prov[$id] == "8" OR $prov[$id] == "11"){
          $in_storage = $region_id;
          $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='$prov[$id]' AND id_product='$iBasket[product_id]' ORDER BY date DESC LIMIT 1");
          $availability = $ava[availability] - $iBasket[quantity];
          mysql_query("UPDATE product SET availability='$availability' WHERE provider='$prov[$id]' AND id='$iBasket[product_id]'");
          mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='$prov[$id]' AND id_product='$iBasket[product_id]'");
      }else{
          $in_storage = '0';
      }

      mysql_query("INSERT INTO order_product (product_id, code, id_order, name, quantity, price, categories, day, sale, price_clear, provider, in_storage) VALUES ('$iBasket[product_id]', '$iBasket[code]', '$last_id', '$name', '$iBasket[quantity]', '$iBasket[price]', '$iBasket[categories]', '$iBasket[day]', '$iBasket[sale]', '$iBasket[price_clear]', '$prov[$id]', '$in_storage')") or die(mysql_error());
    }

   mysql_query("DELETE FROM basket WHERE customer='".session_id()."'") or die(mysql_error());
  }
  header('Location: index.php?code=orders&action=edit&id='.$last_id);
  exit;
}?>