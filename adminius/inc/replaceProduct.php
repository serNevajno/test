<?php
//проверить фильтры товара с фильтрами категории категории куда пересылаем вернуть ответ
if($_SERVER["REQUEST_METHOD"]=="POST") {
  if(!empty($_COOKIE['sid'])){
    session_id($_COOKIE['sid']);
  }
  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php');
  /////Подключение библиотеки
  include($_SERVER['DOCUMENT_ROOT'] . '/adminius/inc/function.inc.php');

  /////Замок
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/lock.inc.php');

  $cat = clearData($_POST['getCat'], "i");
  $subcat = clearData($_POST['subcat'], "i");
  $list = clearData($_POST['res']);

  $arrList = explode(",", $list);

  if(selectFilterCat($subcat) == selectFilterCat($cat)){
    foreach($arrList as $item){
        mysql_query("UPDATE `product` SET categories='$subcat' WHERE id='$item'");
    }
  }else{
      foreach($arrList as $item){
          mysql_query("DELETE FROM filter_value WHERE id_product='$item'") or die(mysql_error());
          mysql_query("UPDATE `product` SET categories='$subcat' WHERE id='$item'");
      }
  }
  echo "ok";
}