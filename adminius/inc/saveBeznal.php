<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  if(!$_POST['upd']) {
    $val = clearData($_POST['val'], "i");
    $id = clearData($_POST['id'], "i");

    mysql_query("UPDATE orders SET beznal='$val' WHERE id='$id'") or die(mysql_error());

    echo "Сохранено!";
  }elseif ($_POST['upd']){
    $val = clearData($_POST['val'], "i");
    $id = clearData($_POST['id'], "i");
    $date = date("Y-m-d H:i:s");

    mysql_query("UPDATE orders SET id_status='1', upd='$val', date_end='$date' WHERE id='$id'") or die(mysql_error());

    echo "Сохранено! УПД Подписан.";
  }
}