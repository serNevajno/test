<?
function recusiveCatSectionGift($id){
  $arrResult = array();
  $arrResult[] = $id;
  $arrCat = selectCategoriesBySectionGift($id);
  if($arrCat['section'] > 0){
    $arrResult = array_merge($arrResult, recusiveCatSectionGift($arrCat["section"]));
  }
  return $arrResult;
}
function selectCategoriesBySectionGift($id=0) {
  return db2array("SELECT id, name, section, active FROM categories WHERE id='$id'");
}
function recusiveFilter($id){
  $fil = db2array("SELECT COUNT(*) as kol FROM filter WHERE categories='$id'");
  if($fil["kol"]>0){
    $arrResult = $id;
  }else{
    $arrCat = selectCategoriesBySectionGift($id);
    if($arrCat['section'] > 0){
      $arrResult = recusiveFilter($arrCat["section"]);
    }else{
      $arrResult = 0;
    }
  }
  return $arrResult;
}
function sGift($cat, $quantity) {
  return db2array("SELECT id_prod, quantity, single, id_filter FROM gift WHERE id_cat='$cat' AND quantity<='$quantity' AND summ = '0'", 2);
}
function checkGiftFilter($id_filter) {
  $res = 0;
  foreach (selectBasket() as $iBas) {
    $temp = db2array("SELECT COUNT(*) AS kol FROM `filter_value` WHERE `id_product`='$iBas[product_id]' AND `element_value`='$id_filter'");
    if($temp["kol"]>0){
      $res = 1;
    }
  }
  return $res;
}
function checkGiftFilterSingle($id_filter, $product_id) {
  $res = 0;
  $temp = db2array("SELECT COUNT(*) AS kol FROM `filter_value` WHERE `id_product`='$product_id' AND `element_value`='$id_filter'");
  if($temp["kol"]>0){
    $res = 1;
  }

  return $res;
}
function selectGift(){
  $arr = array();
  foreach (selectBasket() as $basket) {
    switch ($basket['categories']) {
      case 'tyres':
        $id_cat = '1';
        $cat = '1';
        break;
      case 'disk':
        $id_cat = '2';
        $cat = '2';
        break;
      default:
        $id_cat = '0';
        $id_cat_arr = recusiveCatSectionGift($basket['categories']);
        $cat = $basket['categories'];
        break;
    }
    if ($id_cat == '0') {
      foreach ($id_cat_arr as $iCatArr) {
        if ($arr[$iCatArr]) {
          $arr[$iCatArr] += $basket['quantity'];
        } else {
          $arr[$iCatArr] = $basket['quantity'];
        }
      }
    } else {
      if ($arr[$id_cat]) {
        $arr[$id_cat] += $basket['quantity'];
      } else {
        $arr[$id_cat] = $basket['quantity'];
      }
    }
  }

  $resGift = array();
  foreach ($arr as $key => $iArr) {
    foreach (sGift($key, $iArr) as $iGift) {
      if ($iGift["id_filter"] > 0) {
        if (checkGiftFilter($iGift["id_filter"]) > 0) {
          if ($iGift["single"] == "1") {
            $resGift[] = array(
              "id" => $iGift["id_prod"],
              "quantity" => 1
            );
          } else {
            $resGift[] = array(
              "id" => $iGift["id_prod"],
              "quantity" => $iArr
            );
          }
        }
      } else {
        if ($iGift["single"] == "1") {
          $resGift[] = array(
            "id" => $iGift["id_prod"],
            "quantity" => 1
          );
        } else {
          $resGift[] = array(
            "id" => $iGift["id_prod"],
            "quantity" => $iArr
          );
        }
      }
    }

  }


  $sum = sumBasket();
  $gift = db2array("SELECT id_prod FROM gift WHERE summ<'$sum' AND summ!='0'", 2);
  foreach ($gift as $iGift) {
    $resGift[] = array(
      "id" => $iGift["id_prod"],
      "quantity" => 1
    );
  }
  return $resGift;
}
function selectGiftFastBuy($id_prod, $cat, $quantity, $price){
  $arr = array();


  $id_cat = '0';
  $id_cat_arr = recusiveCatSectionGift($cat);

  if ($id_cat == '0') {
    foreach ($id_cat_arr as $iCatArr) {
      if ($arr[$iCatArr]) {
        $arr[$iCatArr] += $quantity;
      } else {
        $arr[$iCatArr] = $quantity;
      }
    }
  } else {
    if ($arr[$id_cat]) {
      $arr[$id_cat] += $quantity;
    } else {
      $arr[$id_cat] = $quantity;
    }
  }


  $resGift = array();
  foreach ($arr as $key => $iArr) {
    foreach (sGift($key, $iArr) as $iGift) {
      if ($iGift["id_filter"] > 0) {
        if (checkGiftFilterSingle($iGift["id_filter"], $id_prod) > 0) {
          if ($iGift["single"] == "1") {
            $resGift[] = array(
              "id" => $iGift["id_prod"],
              "quantity" => 1
            );
          } else {
            $resGift[] = array(
              "id" => $iGift["id_prod"],
              "quantity" => $iArr
            );
          }
        }
      } else {
        if ($iGift["single"] == "1") {
          $resGift[] = array(
            "id" => $iGift["id_prod"],
            "quantity" => 1
          );
        } else {
          $resGift[] = array(
            "id" => $iGift["id_prod"],
            "quantity" => $iArr
          );
        }
      }
    }

  }


  $sum = $price*$quantity;
  $gift = db2array("SELECT id_prod FROM gift WHERE summ<'$sum' AND summ!='0'", 2);
  foreach ($gift as $iGift) {
    $resGift[] = array(
      "id" => $iGift["id_prod"],
      "quantity" => 1
    );
  }
  return $resGift;
}
?>