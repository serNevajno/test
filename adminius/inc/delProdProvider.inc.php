<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  $id = clearData($_POST["id"], "i");
  $arr = array();

  // Заносим в базу
  if(mysql_query("DELETE FROM `price_provider` WHERE `id_provider`='$id'")){
    $arr['code'] = '2000';
  }else{
    $arr['code'] = '5000';
  }


  echo json_encode($arr);
}