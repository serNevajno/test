<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  $arr = array();
  $id_admin = selectIdUserAdminSession();
  $date = date("Y-m-d H:i:s");

  $res = mysql_query("UPDATE `user_work_time` SET `date_end`='$date' WHERE `id_user`='$id_admin' AND date_end = '0000-00-00 00:00:00'") or die($err = mysql_error());


  if($res) {
    $arr['success'] = 'true';
  }elseif($err){
    $arr['error'] = $err;
  }

  echo json_encode($arr);
}