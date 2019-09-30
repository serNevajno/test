<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  function sDubleOrderById($id){
    return db2array("SELECT `name`, `phone`, `delivery`, `address`, `comment`, `id_user`, `region`, `order_phone` FROM `orders` WHERE id='$id'");
  }

function sDubleProductByOrder($id){
  return db2array("SELECT `product_id`, `code`, `name`, `quantity`, `price`, `categories`, `day`, `sale`, `price_clear`, `provider`, `nzsp`, `in_storage` FROM `order_product` WHERE id_order='$id'", 2);
}

  $id = clearData($_POST['id'], "i");
  $sOrder = sDubleOrderById($id);
  $id_admin = selectIdUserAdminSession();
  $date = date("Y-m-d H:i:s");
  $sProd = sDubleProductByOrder($id);
  $phone = "";

  $arr = array();

  if($sOrder){
    mysql_query("INSERT INTO `orders`(`name`, `phone`, `delivery`, `address`, `comment`, `id_user`, `date`, `id_status`, `id_admin`, `region`, `expectation_hours`, `order_phone`) VALUES ('$sOrder[name]','$sOrder[phone]','$sOrder[delivery]','$sOrder[address]','$sOrder[comment]','$sOrder[id_user]','$date','5','$id_admin','$sOrder[region]','120', '$sOrder[order_phone]')") or die (mysql_error());
    $last_id = mysql_insert_id();

    foreach ($sProd as $item) {
      mysql_query("INSERT INTO `order_product`(`product_id`, `code`, `id_order`, `name`, `quantity`, `price`, `categories`, `day`, `sale`, `price_clear`, `provider`, `nzsp`, `in_storage`) VALUES ('$item[product_id]','$item[code]','$last_id','$item[name]','$item[quantity]','$item[price]','$item[categories]','$item[day]','$item[sale]','$item[price_clear]','$item[provider]','$item[nzsp]','$item[in_storage]')") or die (mysql_error());
    }
  }

  $arr['true'] = 'true';

  echo json_encode($arr);

}