<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  session_start();
  include ($_SERVER['DOCUMENT_ROOT'].'/inc/db.inc.php');
  /////Подключение библиотеки
  include ($_SERVER['DOCUMENT_ROOT'].'/adminius/inc/function.inc.php');

  $arr = array();
  $id_admin = selectIdUserAdminSession();
  $date_start = date("Y-m-d H:i:s");
  $ip = $_SERVER['REMOTE_ADDR'];

  $res = mysql_query("INSERT INTO user_work_time (id_user, ip, date_start) VALUES ('$id_admin', '$ip', '$date_start')")or die($err = mysql_error());

  if($res) {
    $arr['success'] = 'true';
  }elseif($err){
    $arr['error'] = $err;
  }


  echo json_encode($arr);
}