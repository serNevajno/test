<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/gift/function.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){


  $fio = clearData($_POST["fio"]);
  $phone = clearData($_POST["phone"]);
  $address = clearData($_POST["address"]);
  $region_id = clearData($_POST['region'], "i");
  $delivery = clearData($_POST["delivery"]);
  $date = date("Y-m-d H:i:s");
  $quantity = clearData($_POST['modalQuantity']. 'i');
  $prov = clearData($_POST['id_provider'],"i");
  $id_prod = clearData($_POST['id_prod'],'i');
  $id_admin = selectWhatUser();
  $id_user = selectIdUserAdminSession();

  function sProdProviderById($id_prod, $prov){
    return db2array("SELECT t1.name, t2.price, t2.price_clear, t1.sale, t2.logistic, t1.categories FROM product as t1 LEFT JOIN price_provider as t2 on (t1.id = t2.id_product) WHERE t1.id = '$id_prod' AND t2.id_provider = '$prov'");
  }


  if($id_prod){

    mysql_query("INSERT INTO orders (`name`, phone, delivery, address, comment, id_user, `date`, id_status, order_phone, id_admin, region) VALUES ('$fio', '$phone', '$delivery', '$address', '$comment', '$id_user', '$date', '5', 'T', '$id_admin', '$region_id')") or die(mysql_error());
    $last_id = mysql_insert_id();

    $res = sProdProviderById($id_prod, $prov);

    if($prov == "7" OR $prov == "8" OR $prov == "11"){
      $in_storage = $region_id;
      $ava = db2array("SELECT availability FROM price_provider WHERE id_provider='$prov' AND id_product='$id_prod' ORDER BY date DESC LIMIT 1");
      $availability = $ava[availability] - $quantity;
      mysql_query("UPDATE product SET availability='$availability' WHERE provider='$prov' AND id='$id_prod'");
      mysql_query("UPDATE price_provider SET availability='$availability' WHERE id_provider='$prov' AND id_product='$id_prod'");
    }else{
      $in_storage = '0';
    }

    $price = $res["price"] - (($res["price"] / 100)*$res["sale"]);
    mysql_query("INSERT INTO order_product (product_id, id_order, `name`, quantity, price, `day`, sale, price_clear, provider, categories, in_storage) VALUES ('$id_prod', '$last_id', '$res[name]', '$quantity', '$price', '$res[logistic]', '$res[sale]', '$res[price_clear]', '$prov', '$res[categories]', '$in_storage')") or die(mysql_error());


    $gift = selectGiftFastBuy($id_prod, $res['categories'], $quantity, $res["price"]);
    foreach($gift as $iGift){
      $iProd = db2array("SELECT id, name, price, img, code, categories, price_clear, provider FROM product WHERE id='$iGift[id]'");
      mysql_query("INSERT INTO order_product (product_id, id_order, name, quantity, price, categories, day, sale, price_clear, provider, in_storage) VALUES ('$iGift[id]', '$last_id', '$iProd[name]', '$iGift[quantity]', '0', '$iProd[categories]', '0', '0', '$iProd[price_clear]', '$iProd[provider]', '$region_id')") or die(mysql_error());
    }

  }
  header('Location: index.php?code=orders&action=edit&id='.$last_id);
  exit;
}?>