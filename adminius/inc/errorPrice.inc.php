<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/uploadProduct/upFunc.inc.php');
    $temp = db2array("SELECT t1.id FROM `product` as t1 WHERE (SELECT COUNT(*) FROM price_provider WHERE id_product=t1.id AND id_provider=t1.provider)=0 AND t1.provider>0", 2);

    foreach($temp as $item){
        $googPrice = selectGoodPrice($item["id"]);
        if($googPrice[logistic] != "777"){
           mysql_query("UPDATE `product` SET price='$googPrice[price]', price_clear='$googPrice[price_clear]', logistic='$googPrice[logistic]', provider='$googPrice[id_provider]', availability='$googPrice[availability]' WHERE id='$item[id]'");
        }else {
           mysql_query("UPDATE `product` SET price='0', price_clear='0', logistic='0', provider='0', availability='0' WHERE id='$item[id]'");
        }
    }
    //////
  $arr = array();
  $arrCat = recusiveCatSection('1');
  $query_search.="t1.categories IN (";
  $n = 1;
  $zp="";
  $id="";

  foreach ($arrCat as $iCat){
    if($n>1) $zp=", ";
    $query_search.= $zp.$iCat;
    $id.= $zp.$iCat;
    $n++;
  }
  $arrCat = recusiveCatSection('2');
  $n = 1;
  $zp="";
  $id="";

  foreach ($arrCat as $iCat){
    $zp=", ";
    $query_search.= $zp.$iCat;
    $id.= $zp.$iCat;
    $n++;
  }
  $query_search.= ")";

  $posts = db2array("SELECT t1.* FROM product as t1 WHERE $query_search AND (SELECT COUNT(*) FROM price_provider WHERE id_product=t1.id AND id_provider=t1.provider)=0 AND t1.price>0", 2);

  foreach($posts as $item){
    mysql_query("UPDATE `product` SET price='0', price_clear='0', logistic='0', provider='0', availability='0' WHERE id='$item[id]'");
  }
    /////
    header("Location: /adminius/index.php?code=product&action=upload");
    exit();
}
?>