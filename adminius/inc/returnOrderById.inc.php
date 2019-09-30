<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/inc/function.inc.php');

function selectOrderByIdReturn($id) {
  return db2array("SELECT t1.date, t1.name, t1.phone, t1.summ, t1.cause, t1.beznal, t1.upd, t1.prepayment, t1.address, t1.delivery, t1.comment, t1.id_status, t1.comments, t1.date_comm, t3.name as name_user, t3.phone as phone_user, t3.email, t3.address as address_user, t3.sex, t3.city, t2.name as status, t2.code as code_status, t1.order_phone, t1.prepayment_date, t1.id_user, t1.in_card, t4.name as name_admin_comm, t1.pdzz, t5.region as name_region, t5.id as region_id, t1.expectation_hours FROM orders as t1
			LEFT JOIN status as t2 on(t1.id_status = t2.id) 
			LEFT JOIN users as t3 on(t1.id_user = t3.id) 
			LEFT JOIN admin_user as t4 on(t1.id_admin_comm=t4.id)
			LEFT JOIN region as t5 on (t1.region=t5.id) WHERE t1.id='$id'");
}

function selectOrderProductByIdReturn($id){
  return db2array("SELECT t1.id, t1.product_id, t1.quantity, t1.price, t1.price_clear, t1.categories, t1.provider as id_provider FROM order_product as t1 
			LEFT JOIN categories as t2 on (t1.categories = t2.code) 
			LEFT JOIN product as t3 on (t1.product_id = t3.id) 
			LEFT JOIN orders as t4 on ('$id' = t4.id) 
			LEFT JOIN provider as t5 on(t1.provider=t5.id)
		    WHERE t1.id_order='$id'", 2);
}

function sProdById($id, $id_prov){
  return db2array("SELECT * FROM price_provider WHERE id_product='$id' AND id_provider='$id_prov'");
}

$id_orders = clearData($_POST['id'], 'i');
$prom = clearData($_POST['prom']);
$date_end = date("Y-m-d H:i:s");


$sOrder = selectOrderByIdReturn($id_orders);
if($sOrder){
  $comm = $sOrder['comments']."\r".$prom;
  mysql_query("UPDATE `orders` SET `id_status`='4',`comments`='$comm',`date_end`='$date_end' WHERE id='$id_orders'") or die(mysql_error());

  $sProd = selectOrderProductByIdReturn($id_orders);

  switch($sOrder['region_id']){
    case 1: $id_provider = 7; break;
    case 2: $id_provider = 8; break;
    case 3: $id_provider = 11; break;
  }

  if($sProd) {
    foreach ($sProd as $prod) {
      $temp =  sProdById($prod['product_id'], $id_provider);
      if ($temp) {
        $col = (int)$prod['quantity'] + (int)$temp['availability'];
        mysql_query("UPDATE `price_provider` SET `availability`='$col',`date`='$date_end' WHERE id_product='$prod[product_id]' AND id_provider='$id_provider'") or die(mysql_error());
      } else {
        mysql_query("INSERT INTO `price_provider`(`id_product`, `price`, `price_clear`, `logistic`, `id_provider`, `availability`, `date`) VALUES ('$prod[product_id]','$prod[price]','$prod[price_clear]','0','$id_provider','$prod[quantity]','$date_end')") or die(mysql_error());

      }
    }
  }
}
echo "успешно";
